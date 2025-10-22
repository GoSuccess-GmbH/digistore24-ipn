<?php

/**
 * Quick Start Example
 * 
 * The simplest possible IPN handler.
 * Copy this code and customize it for your needs.
 */

declare(strict_types=1);

require_once __DIR__ . '/../vendor/autoload.php';

use GoSuccess\Digistore24\Ipn\{Notification, Response};
use GoSuccess\Digistore24\Ipn\Enum\Event;
use GoSuccess\Digistore24\Ipn\Security\Signature;
use GoSuccess\Digistore24\Ipn\Exception\FormatException;

// Your IPN secret from Digistore24
$secret = 'YOUR_SECRET_HERE';

try {
    // Validate signature
    Signature::validateSignature($secret, $_POST);
    
    // Get IPN data
    $notification = Notification::fromPost();
    
    // Handle payment
    if ($notification->event === Event::ON_PAYMENT) {
        
        // Get order details
        $orderId = $notification->order_id;
        $email = $notification->email;
        $amount = $notification->amount_brutto;
        
        // Your code: Create user, grant access, etc.
        // ...
        
        // Optional: Return login credentials
        $response = new Response();
        $response->headline = 'Welcome!';
        $response->addLoginBlock(
            'username',
            'password',
            'https://yoursite.com/login'
        );
        die($response->toString());
    }
    
    echo "OK";
    
} catch (FormatException $e) {
    http_response_code(400);
    die('ERROR');
}
