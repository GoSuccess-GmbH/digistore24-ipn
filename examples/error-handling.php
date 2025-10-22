<?php

/**
 * IPN Error Handling Examples
 *
 * This example demonstrates various error handling patterns when working with IPN notifications:
 * - Signature validation failures
 * - Invalid data format
 * - Business logic validation errors
 * - Exception handling strategies
 * - Error logging patterns
 */

declare(strict_types=1);

use GoSuccess\Digistore24\Ipn\Enum\Event;
use GoSuccess\Digistore24\Ipn\Exception\FormatException;
use GoSuccess\Digistore24\Ipn\Notification;
use GoSuccess\Digistore24\Ipn\Response;
use GoSuccess\Digistore24\Ipn\Security\Signature;

require_once __DIR__ . '/../vendor/autoload.php';

// Example 1: Handling signature validation errors
echo "=== Example 1: Signature Validation Error Handling ===\n\n";

function handleSignatureValidation(): void
{
    $shaPassphrase = 'your-secret-passphrase';
    $postData = [
        'event' => 'on_payment',
        'order_id' => '12345',
        'sha_sign' => 'invalid_signature_here',
    ];

    try {
        Signature::validateSignature($shaPassphrase, $postData);
        echo "✓ Signature valid\n";
    } catch (FormatException $e) {
        // This is expected for invalid signatures
        echo "✗ Signature validation failed: {$e->getMessage()}\n";
        echo "  Action: Log attempt, send 403 response, block IP if repeated\n\n";

        // In production:
        // - Log the failed attempt with IP address
        // - Increment failed attempt counter
        // - Consider blocking IP after X failed attempts
        // - Send alert if threshold exceeded
        error_log("IPN signature validation failed from IP: " . ($_SERVER['REMOTE_ADDR'] ?? 'unknown'));
        http_response_code(403);
        // exit('Forbidden');
    }
}

handleSignatureValidation();

// Example 2: Handling missing signature
echo "=== Example 2: Missing Signature Handling ===\n\n";

function handleMissingSignature(): void
{
    $shaPassphrase = 'your-secret-passphrase';
    $postData = [
        'event' => 'on_payment',
        'order_id' => '12345',
        // Missing sha_sign or SHASIGN field
    ];

    try {
        Signature::validateSignature($shaPassphrase, $postData);
        echo "✓ Signature valid\n";
    } catch (FormatException $e) {
        echo "✗ No signature found: {$e->getMessage()}\n";
        echo "  Action: Reject request immediately\n\n";

        // In production:
        error_log("IPN request without signature from IP: " . ($_SERVER['REMOTE_ADDR'] ?? 'unknown'));
        http_response_code(400);
        // exit('Bad Request: Missing signature');
    }
}

handleMissingSignature();

// Example 3: Handling invalid data format
echo "=== Example 3: Invalid Data Format Handling ===\n\n";

function handleInvalidData(): void
{
    // Simulate corrupted IPN data
    $postData = [
        'event' => 'invalid_event_type',
        'order_id' => 'not-a-number',
        'amount_brutto' => 'invalid-amount',
        'email' => 'not-an-email',
    ];

    try {
        $notification = Notification::fromArray($postData);

        // Business validation
        if (!filter_var($notification->email, FILTER_VALIDATE_EMAIL)) {
            throw new InvalidArgumentException("Invalid email format: {$notification->email}");
        }

        if ($notification->amount_brutto <= 0) {
            throw new InvalidArgumentException("Invalid amount: {$notification->amount_brutto}");
        }

        echo "✓ Data valid\n";
    } catch (Throwable $e) {
        echo "✗ Data validation failed: {$e->getMessage()}\n";
        echo "  Type: " . get_class($e) . "\n";
        echo "  Action: Log error, send 400 response\n\n";

        // In production:
        error_log("IPN data validation failed: " . $e->getMessage());
        http_response_code(400);
        // exit('Bad Request: Invalid data');
    }
}

handleInvalidData();

// Example 4: Comprehensive error handler with retry logic
echo "=== Example 4: Comprehensive Error Handler ===\n\n";

class IPNErrorHandler
{
    private string $logFile;
    private int $maxRetries = 3;

    public function __construct(string $logFile)
    {
        $this->logFile = $logFile;
    }

    public function handleIPNRequest(array $postData, string $passphrase): void
    {
        $attemptNumber = 0;

        while ($attemptNumber < $this->maxRetries) {
            $attemptNumber++;

            try {
                // Step 1: Validate signature
                $this->validateSignature($postData, $passphrase);

                // Step 2: Parse notification
                $notification = $this->parseNotification($postData);

                // Step 3: Validate business rules
                $this->validateBusinessRules($notification);

                // Step 4: Process notification
                $this->processNotification($notification);

                $this->log("IPN processed successfully", 'INFO');
                echo "✓ IPN processed successfully\n";
                return;

            } catch (FormatException $e) {
                // Critical error - don't retry
                $this->log("Signature/format error: {$e->getMessage()}", 'ERROR');
                echo "✗ Critical error: {$e->getMessage()}\n";
                http_response_code(403);
                return;

            } catch (InvalidArgumentException $e) {
                // Business validation error - don't retry
                $this->log("Validation error: {$e->getMessage()}", 'ERROR');
                echo "✗ Validation error: {$e->getMessage()}\n";
                http_response_code(400);
                return;

            } catch (RuntimeException $e) {
                // Temporary error - might retry
                $this->log("Runtime error (attempt {$attemptNumber}/{$this->maxRetries}): {$e->getMessage()}", 'WARNING');
                echo "✗ Runtime error (attempt {$attemptNumber}): {$e->getMessage()}\n";

                if ($attemptNumber >= $this->maxRetries) {
                    $this->log("Max retries exceeded", 'ERROR');
                    echo "✗ Max retries exceeded\n";
                    http_response_code(500);
                    return;
                }

                // Wait before retry (exponential backoff)
                sleep(pow(2, $attemptNumber - 1));

            } catch (Throwable $e) {
                // Unexpected error
                $this->log("Unexpected error: {$e->getMessage()} in {$e->getFile()}:{$e->getLine()}", 'CRITICAL');
                echo "✗ Unexpected error: {$e->getMessage()}\n";
                http_response_code(500);
                return;
            }
        }
    }

    private function validateSignature(array $postData, string $passphrase): void
    {
        Signature::validateSignature($passphrase, $postData);
    }

    private function parseNotification(array $postData): Notification
    {
        return Notification::fromArray($postData);
    }

    private function validateBusinessRules(Notification $notification): void
    {
        // Email validation
        if (!filter_var($notification->email, FILTER_VALIDATE_EMAIL)) {
            throw new InvalidArgumentException("Invalid email: {$notification->email}");
        }

        // Amount validation
        if ($notification->amount_brutto !== null && $notification->amount_brutto <= 0) {
            throw new InvalidArgumentException("Invalid amount: {$notification->amount_brutto}");
        }

        // Order ID validation
        if ($notification->order_id !== null && $notification->order_id <= 0) {
            throw new InvalidArgumentException("Invalid order ID: {$notification->order_id}");
        }
    }

    private function processNotification(Notification $notification): void
    {
        // Simulate processing that might fail temporarily
        if (random_int(0, 100) < 30) { // 30% chance of temporary failure
            throw new RuntimeException("Database connection timeout");
        }

        // Process based on event type
        match ($notification->event) {
            Event::ON_PAYMENT => $this->handlePayment($notification),
            Event::ON_REFUND => $this->handleRefund($notification),
            Event::CONNECTION_TEST => $this->handleConnectionTest(),
            default => $this->log("Unhandled event: {$notification->event->value}", 'WARNING'),
        };
    }

    private function handlePayment(Notification $notification): void
    {
        $this->log("Payment processed: Order {$notification->order_id}", 'INFO');
        // Your payment logic here
    }

    private function handleRefund(Notification $notification): void
    {
        $this->log("Refund processed: Order {$notification->order_id}", 'INFO');
        // Your refund logic here
    }

    private function handleConnectionTest(): void
    {
        $this->log("Connection test received", 'INFO');
        echo "OK\n";
    }

    private function log(string $message, string $level): void
    {
        $timestamp = date('Y-m-d H:i:s');
        $logEntry = "[{$timestamp}] [{$level}] {$message}\n";
        file_put_contents($this->logFile, $logEntry, FILE_APPEND | LOCK_EX);
    }
}

// Test the comprehensive error handler
$handler = new IPNErrorHandler(sys_get_temp_dir() . '/ipn_errors.log');

$testData = [
    'event' => 'on_payment',
    'order_id' => '12345',
    'amount_brutto' => '49.99',
    'email' => 'test@example.com',
];

$handler->handleIPNRequest($testData, 'test-passphrase');

echo "\n=== Example 5: Error Recovery Strategies ===\n\n";

// Strategy 1: Circuit Breaker Pattern
class CircuitBreaker
{
    private const MAX_FAILURES = 5;
    private const TIMEOUT = 60; // seconds

    private string $stateFile;

    public function __construct(string $stateFile)
    {
        $this->stateFile = $stateFile;
    }

    public function canProcess(): bool
    {
        if (!file_exists($this->stateFile)) {
            return true;
        }

        $state = json_decode(file_get_contents($this->stateFile), true);
        $failures = $state['failures'] ?? 0;
        $lastFailure = $state['last_failure'] ?? 0;

        // Reset if timeout passed
        if (time() - $lastFailure > self::TIMEOUT) {
            $this->reset();
            return true;
        }

        // Block if too many failures
        if ($failures >= self::MAX_FAILURES) {
            echo "Circuit breaker OPEN - too many failures\n";
            return false;
        }

        return true;
    }

    public function recordFailure(): void
    {
        $state = file_exists($this->stateFile)
            ? json_decode(file_get_contents($this->stateFile), true)
            : ['failures' => 0, 'last_failure' => 0];

        $state['failures']++;
        $state['last_failure'] = time();

        file_put_contents($this->stateFile, json_encode($state), LOCK_EX);
    }

    public function reset(): void
    {
        if (file_exists($this->stateFile)) {
            unlink($this->stateFile);
        }
    }
}

$circuitBreaker = new CircuitBreaker(sys_get_temp_dir() . '/ipn_circuit_breaker.json');

if ($circuitBreaker->canProcess()) {
    echo "✓ Circuit breaker CLOSED - processing allowed\n";
    // Process IPN
} else {
    echo "✗ Circuit breaker OPEN - processing blocked\n";
    http_response_code(503);
    // exit('Service temporarily unavailable');
}

echo "\n=== Best Practices Summary ===\n\n";
echo "1. ✓ Always validate signatures first\n";
echo "2. ✓ Use specific exception types for different error scenarios\n";
echo "3. ✓ Log all errors with context (IP, timestamp, data)\n";
echo "4. ✓ Return appropriate HTTP status codes\n";
echo "5. ✓ Implement rate limiting and circuit breakers\n";
echo "6. ✓ Don't retry critical errors (signature, validation)\n";
echo "7. ✓ Use exponential backoff for temporary failures\n";
echo "8. ✓ Monitor error rates and set up alerts\n";
echo "9. ✓ Never expose sensitive data in error messages\n";
echo "10. ✓ Test error scenarios in staging environment\n";
