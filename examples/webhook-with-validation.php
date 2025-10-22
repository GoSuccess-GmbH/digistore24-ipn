<?php

/**
 * Complete IPN Webhook Handler with Security Best Practices
 *
 * This example demonstrates a production-ready IPN webhook endpoint with:
 * - Signature validation (fraud prevention)
 * - Request method validation (POST only)
 * - Rate limiting
 * - Comprehensive error handling
 * - Logging
 * - All event types handling
 *
 * @link https://dev.digistore24.com/hc/en-us/articles/32480217565969-Quick-Integration-Guide
 */

declare(strict_types=1);

use GoSuccess\Digistore24\Ipn\Enum\Event;
use GoSuccess\Digistore24\Ipn\Exception\FormatException;
use GoSuccess\Digistore24\Ipn\Notification;
use GoSuccess\Digistore24\Ipn\Response;
use GoSuccess\Digistore24\Ipn\Security\Signature;

require_once __DIR__ . '/../vendor/autoload.php';

// Configuration - Load from environment variables in production!
$config = [
    'ipn_passphrase' => $_ENV['DIGISTORE24_IPN_PASSPHRASE'] ?? 'your-secret-passphrase',
    'enable_logging' => true,
    'log_file' => __DIR__ . '/../logs/ipn.log',
    'rate_limit_max' => 100, // Max requests per minute
    'rate_limit_window' => 60, // In seconds
];

// Helper function for logging
function logMessage(string $message, string $level = 'INFO'): void
{
    global $config;

    if (!$config['enable_logging']) {
        return;
    }

    $timestamp = date('Y-m-d H:i:s');
    $logEntry = "[{$timestamp}] [{$level}] {$message}\n";

    // Ensure log directory exists
    $logDir = dirname($config['log_file']);
    if (!is_dir($logDir)) {
        mkdir($logDir, 0755, true);
    }

    file_put_contents($config['log_file'], $logEntry, FILE_APPEND | LOCK_EX);
}

// Helper function for rate limiting (simple file-based)
function checkRateLimit(): void
{
    global $config;

    $ip = $_SERVER['REMOTE_ADDR'] ?? 'unknown';
    $rateLimitFile = sys_get_temp_dir() . '/ipn_rate_limit_' . md5($ip) . '.txt';

    // Read current request count
    if (file_exists($rateLimitFile)) {
        $data = json_decode(file_get_contents($rateLimitFile), true);
        $lastReset = $data['last_reset'] ?? 0;
        $requestCount = $data['count'] ?? 0;

        // Reset counter if window expired
        if (time() - $lastReset > $config['rate_limit_window']) {
            $requestCount = 0;
            $lastReset = time();
        }
    } else {
        $requestCount = 0;
        $lastReset = time();
    }

    // Check limit
    if ($requestCount >= $config['rate_limit_max']) {
        logMessage("Rate limit exceeded for IP: {$ip}", 'WARNING');
        http_response_code(429);
        header('Retry-After: ' . $config['rate_limit_window']);
        die('Rate limit exceeded. Please try again later.');
    }

    // Increment counter
    $requestCount++;
    file_put_contents(
        $rateLimitFile,
        json_encode(['last_reset' => $lastReset, 'count' => $requestCount]),
        LOCK_EX
    );
}

// Start processing
try {
    logMessage('IPN webhook called from IP: ' . ($_SERVER['REMOTE_ADDR'] ?? 'unknown'));

    // 1. Validate request method (must be POST)
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        logMessage('Invalid request method: ' . $_SERVER['REQUEST_METHOD'], 'ERROR');
        http_response_code(405);
        header('Allow: POST');
        die('Method not allowed. Only POST requests are accepted.');
    }

    // 2. Check rate limiting
    checkRateLimit();

    // 3. Validate signature (CRITICAL for security!)
    try {
        Signature::validateSignature($config['ipn_passphrase'], $_POST);
        logMessage('Signature validation successful');
    } catch (FormatException $e) {
        logMessage('Signature validation failed: ' . $e->getMessage(), 'ERROR');
        http_response_code(403);
        die('Invalid signature. Request rejected.');
    }

    // 4. Create notification object from validated POST data
    $notification = Notification::fromPost();

    // Log basic information
    logMessage(sprintf(
        'Processing IPN - Event: %s, Order: %s, Email: %s',
        $notification->event->value,
        $notification->order_id ?? 'N/A',
        $notification->email ?? 'N/A'
    ));

    // 5. Process based on event type
    switch ($notification->event) {
        case Event::ON_PAYMENT:
            handlePayment($notification);
            break;

        case Event::ON_PAYMENT_MISSED:
            handlePaymentMissed($notification);
            break;

        case Event::ON_REFUND:
            handleRefund($notification);
            break;

        case Event::ON_CHARGEBACK:
            handleChargeback($notification);
            break;

        case Event::LAST_PAID_DAY:
            handleLastPaidDay($notification);
            break;

        case Event::ON_REBILL_RESUMED:
        case Event::ON_REBILL_CANCELLED:
            handleRebilling($notification);
            break;

        case Event::ON_AFFILIATION:
        case Event::ETICKET:
        case Event::CUSTOM_FORM:
            handleOtherEvents($notification);
            break;

        default:
            logMessage('Unknown event type: ' . $notification->event->value, 'WARNING');
            http_response_code(200);
            echo 'OK';
    }

    logMessage('IPN processing completed successfully');

} catch (FormatException $e) {
    logMessage('Format exception: ' . $e->getMessage(), 'ERROR');
    http_response_code(400);
    echo 'ERROR: Invalid data format';

} catch (Throwable $e) {
    logMessage('Unexpected error: ' . $e->getMessage() . ' in ' . $e->getFile() . ':' . $e->getLine(), 'CRITICAL');
    http_response_code(500);
    echo 'ERROR: Internal server error';
}

// Event handler functions

function handlePayment(Notification $notification): void
{
    logMessage("Payment received: {$notification->transaction_amount} EUR for order {$notification->order_id}");

    // TODO: Your business logic here:
    // - Create user account
    // - Grant access to product
    // - Send confirmation email
    // - Update database

    // Validate amount
    if ($notification->amount_brutto <= 0) {
        logMessage('Invalid payment amount: ' . $notification->amount_brutto, 'ERROR');
        http_response_code(400);
        die('ERROR: Invalid amount');
    }

    // Validate email
    if (!filter_var($notification->email, FILTER_VALIDATE_EMAIL)) {
        logMessage('Invalid email: ' . $notification->email, 'ERROR');
        http_response_code(400);
        die('ERROR: Invalid email');
    }

    // Example: Generate login credentials
    $username = substr($notification->email, 0, strpos($notification->email, '@'));
    $password = bin2hex(random_bytes(8)); // Generate secure password

    // Send custom response with login data
    $response = new Response();
    $response->headline = 'Thank you for your purchase!';
    $response->addLoginBlock(
        $username,
        $password,
        'https://example.com/login'
    );
    $response->setAdditionalData('Order ID', (string) $notification->order_id);
    $response->setAdditionalData('License Key', generateLicenseKey());

    logMessage("Sending response with login credentials for {$notification->email}");
    die($response->toString());
}

function handlePaymentMissed(Notification $notification): void
{
    logMessage("Payment missed for order {$notification->order_id}", 'WARNING');

    // TODO: Your business logic here:
    // - Send payment reminder email
    // - Suspend account access
    // - Start dunning process

    http_response_code(200);
    echo 'OK';
}

function handleRefund(Notification $notification): void
{
    logMessage("Refund processed: {$notification->transaction_amount} EUR for order {$notification->order_id}");

    // TODO: Your business logic here:
    // - Revoke product access
    // - Update billing records
    // - Send confirmation email

    http_response_code(200);
    echo 'OK';
}

function handleChargeback(Notification $notification): void
{
    logMessage("Chargeback initiated for order {$notification->order_id}", 'WARNING');

    // TODO: Your business logic here:
    // - Immediately revoke access
    // - Flag account
    // - Notify fraud team

    http_response_code(200);
    echo 'OK';
}

function handleLastPaidDay(Notification $notification): void
{
    logMessage("Last paid day reached for subscription {$notification->order_id}");

    // TODO: Your business logic here:
    // - Revoke subscription access
    // - Send notification email
    // - Archive subscription data

    http_response_code(200);
    echo 'OK';
}

function handleRebilling(Notification $notification): void
{
    logMessage("Rebilling event: {$notification->event->value} for order {$notification->order_id}");

    // TODO: Your business logic here based on specific rebilling event:
    // - ON_REBILL_RESUMED: Subscription resumed after pause
    // - ON_REBILL_CANCELLED: Subscription cancelled

    if ($notification->event === Event::ON_REBILL_RESUMED) {
        // Subscription resumed - grant access again
        logMessage("Subscription resumed for order {$notification->order_id}");
    } elseif ($notification->event === Event::ON_REBILL_CANCELLED) {
        // Subscription cancelled - will end on LAST_PAID_DAY event
        logMessage("Subscription cancelled for order {$notification->order_id}");
    }

    http_response_code(200);
    echo 'OK';
}

function handleOtherEvents(Notification $notification): void
{
    logMessage("Other event: {$notification->event->value} for order {$notification->order_id}");

    // TODO: Handle additional events:
    // - ON_AFFILIATION: Affiliate wants to promote product
    // - ETICKET: E-ticket created or updated
    // - CUSTOM_FORM: Custom form data completed

    http_response_code(200);
    echo 'OK';
}

// Helper function to generate license key (example)
function generateLicenseKey(): string
{
    return strtoupper(sprintf(
        '%s-%s-%s-%s',
        bin2hex(random_bytes(4)),
        bin2hex(random_bytes(4)),
        bin2hex(random_bytes(4)),
        bin2hex(random_bytes(4))
    ));
}
