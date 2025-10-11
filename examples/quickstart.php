<?php

/**
 * Quick Start Example
 * 
 * The simplest possible IPN handler.
 * Copy this code and customize it for your needs.
 */

declare(strict_types=1);

require_once __DIR__ . '/../vendor/autoload.php';

use GoSuccess\Digistore24IPN\Dto\IPNRequestDto;
use GoSuccess\Digistore24IPN\Dto\IPNResponseDto;
use GoSuccess\Digistore24IPN\Enum\Event;
use GoSuccess\Digistore24IPN\Helper\SignatureHelper;
use GoSuccess\Digistore24IPN\Exception\IPNResponseFormatException;

// Your IPN secret from Digistore24
$secret = 'YOUR_SECRET_HERE';

try {
    // Validate signature
    SignatureHelper::validateSignature($secret, $_POST);
    
    // Get IPN data
    $ipn = IPNRequestDto::fromPost();
    
    // Handle payment
    if ($ipn->event === Event::ON_PAYMENT) {
        
        // Get order details
        $orderId = $ipn->order_id;
        $email = $ipn->email;
        $amount = $ipn->amount_brutto;
        
        // Your code: Create user, grant access, etc.
        // ...
        
        // Optional: Return login credentials
        $response = new IPNResponseDto();
        $response->headline = 'Welcome!';
        $response->addLoginBlock(
            'username',
            'password',
            'https://yoursite.com/login'
        );
        die($response->toString());
    }
    
    echo "OK";
    
} catch (IPNResponseFormatException $e) {
    http_response_code(400);
    die('ERROR');
}
