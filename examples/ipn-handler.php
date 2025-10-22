<?php

/**
 * Example: Digistore24 IPN Handler
 * 
 * This example demonstrates a complete IPN handler implementation
 * with logging, error handling, and response generation.
 */

declare(strict_types=1);

require_once __DIR__ . '/vendor/autoload.php';

use GoSuccess\Digistore24\Ipn\{Request, Response};
use GoSuccess\Digistore24\Ipn\Enum\Event;
use GoSuccess\Digistore24\Ipn\Security\Signature;
use GoSuccess\Digistore24\Ipn\Exception\FormatException;

// Configuration
$shaPassphrase = getenv('DIGISTORE24_IPN_SECRET') ?: 'your-secret-passphrase';
$logFile = __DIR__ . '/logs/ipn.log';

// Helper function for logging
function logIpn(string $message, array $context = []): void
{
    global $logFile;
    $timestamp = date('Y-m-d H:i:s');
    $contextStr = !empty($context) ? json_encode($context) : '';
    $logMessage = "[$timestamp] $message $contextStr\n";
    file_put_contents($logFile, $logMessage, FILE_APPEND);
}

try {
    // Get IPN data
    $ipnData = $_POST ?: $_GET;

    if (empty($ipnData)) {
        throw new FormatException('No IPN data received');
    }

    logIpn('IPN received', ['data' => $ipnData]);

    // Validate signature
    Signature::validateSignature($shaPassphrase, $ipnData);
    logIpn('Signature validated successfully');

    // Create DTO from IPN data
    $ipnRequest = Request::fromArray($ipnData);

    // Extract common fields
    $event = $ipnRequest->event;
    $orderId = $ipnRequest->order_id;
    $email = $ipnRequest->email;
    $amount = $ipnRequest->amount_brutto;

    logIpn('Processing event', [
        'event' => $event->value,
        'order_id' => $orderId,
        'email' => $email,
        'amount' => $amount,
    ]);

    // Process based on event type
    switch ($event) {
        case Event::ON_PAYMENT:
            handlePayment($ipnRequest);
            break;

        case Event::ON_REFUND:
            handleRefund($ipnRequest);
            break;

        case Event::ON_CHARGEBACK:
            handleChargeback($ipnRequest);
            break;

        case Event::ON_PAYMENT_MISSED:
            handlePaymentMissed($ipnRequest);
            break;

        case Event::ON_REBILL_CANCELLED:
            handleRebillCancelled($ipnRequest);
            break;

        case Event::ON_REBILL_RESUMED:
            handleRebillResumed($ipnRequest);
            break;

        case Event::LAST_PAID_DAY:
            handleLastPaidDay($ipnRequest);
            break;

        case Event::CONNECTION_TEST:
            logIpn('Connection test received');
            echo "OK";
            exit;

        default:
            logIpn('Unknown event type', ['event' => $event->value]);
            echo "OK";
            exit;
    }

    // Default response
    echo "OK";

} catch (FormatException $e) {
    logIpn("IPN Error: {$e->getMessage()}");
    http_response_code(400);
    echo "ERROR: " . htmlspecialchars($e->getMessage());
    exit;

} catch (\Exception $e) {
    logIpn("Unexpected error: {$e->getMessage()}");
    http_response_code(500);
    echo 'ERROR: Internal server error';
    exit;
}

/**
 * Handle successful payment
 */
function handlePayment(Request $ipn): void
{
    $orderId = $ipn->order_id;
    $email = $ipn->email;
    
    // Get all product IDs (supports multiple products in one order)
    $productIds = [];
    if ($ipn->product_id) {
        $productIds[] = $ipn->product_id;
    }
    
    // If there are multiple products, they're in product_ids as comma-separated string
    if ($ipn->product_ids) {
        $additionalIds = array_map('intval', explode(',', $ipn->product_ids));
        $productIds = array_merge($productIds, $additionalIds);
    }
    
    // Remove duplicates and reindex
    $productIds = array_values(array_unique($productIds));
    
    logIpn('Processing payment', [
        'order_id' => $orderId,
        'email' => $email,
        'products' => $productIds,
    ]);

    // Your business logic here:
    // 1. Create user account or update existing
    // 2. Grant access to products
    // 3. Send welcome email
    // 4. Generate license keys if needed

    // Example: Generate and return login credentials
    $response = new Response();
    $response->headline = 'Your Access Details';
    
    // Generate login credentials (example)
    $username = generateUsername($email);
    $password = generatePassword();
    
    // Save credentials to database
    // saveUserCredentials($orderId, $username, $password);
    
    $response->addLoginBlock(
        $username,
        $password,
        'https://yourapp.com/login'
    );
    
    // Add license key if applicable
    if (count($productIds) > 0) {
        $licenseKey = generateLicenseKey($orderId);
        $response->setAdditionalData('License Key', $licenseKey);
    }
    
    logIpn('Payment processed successfully', ['order_id' => $orderId]);
    
    die($response->toString());
}

/**
 * Handle refund
 */
function handleRefund(Request $ipn): void
{
    $orderId = $ipn->order_id;
    $email = $ipn->email;
    
    logIpn('Processing refund', [
        'order_id' => $orderId,
        'email' => $email,
    ]);

    // Your business logic here:
    // 1. Revoke access to products
    // 2. Deactivate user account
    // 3. Cancel licenses
    // 4. Send refund confirmation email
    
    // revokeAccess($orderId);
    // deactivateLicenses($orderId);
    
    logIpn('Refund processed successfully', ['order_id' => $orderId]);
}

/**
 * Handle chargeback
 */
function handleChargeback(Request $ipn): void
{
    $orderId = $ipn->order_id;
    
    logIpn('Processing chargeback', ['order_id' => $orderId]);

    // Similar to refund handling
    // revokeAccess($orderId);
    // flagAccountForReview($orderId);
    
    logIpn('Chargeback processed successfully', ['order_id' => $orderId]);
}

/**
 * Handle missed payment
 */
function handlePaymentMissed(Request $ipn): void
{
    $orderId = $ipn->order_id;
    $email = $ipn->email;
    
    logIpn('Processing missed payment', [
        'order_id' => $orderId,
        'email' => $email,
    ]);

    // Your business logic here:
    // 1. Temporarily suspend access
    // 2. Send payment reminder email
    // 3. Log for follow-up
    
    // temporarilySuspendAccess($orderId);
    // sendPaymentReminder($email);
    
    logIpn('Missed payment processed', ['order_id' => $orderId]);
}

/**
 * Handle rebilling cancelled
 */
function handleRebillCancelled(Request $ipn): void
{
    $orderId = $ipn->order_id;
    
    logIpn('Processing rebill cancellation', ['order_id' => $orderId]);

    // Note: Access should remain until last_paid_day event
    // updateSubscriptionStatus($orderId, 'cancelled');
    
    logIpn('Rebill cancellation processed', ['order_id' => $orderId]);
}

/**
 * Handle rebilling resumed
 */
function handleRebillResumed(Request $ipn): void
{
    $orderId = $ipn->order_id;
    
    logIpn('Processing rebill resumption', ['order_id' => $orderId]);

    // Your business logic here:
    // 1. Restore full access if suspended
    // 2. Update subscription status
    
    // restoreAccess($orderId);
    // updateSubscriptionStatus($orderId, 'active');
    
    logIpn('Rebill resumption processed', ['order_id' => $orderId]);
}

/**
 * Handle last paid day
 */
function handleLastPaidDay(Request $ipn): void
{
    $orderId = $ipn->order_id;
    $email = $ipn->email;
    
    logIpn('Processing last paid day', [
        'order_id' => $orderId,
        'email' => $email,
    ]);

    // Your business logic here:
    // 1. Permanently revoke access
    // 2. Deactivate subscription
    // 3. Send goodbye/reactivation email
    
    // revokeAccess($orderId);
    // deactivateSubscription($orderId);
    // sendGoodbyeEmail($email);
    
    logIpn('Last paid day processed', ['order_id' => $orderId]);
}

// Helper functions (implement these according to your needs)

function generateUsername(string $email): string
{
    $localPart = explode('@', $email)[0];
    $randomNumber = rand(1000, 9999);
    return "{$localPart}{$randomNumber}";
}

function generatePassword(): string
{
    return bin2hex(random_bytes(8));
}

function generateLicenseKey(string $orderId): string
{
    return strtoupper(substr(md5($orderId . time()), 0, 20));
}
