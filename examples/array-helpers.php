<?php

/**
 * Example: Working with IPN Data
 * 
 * Demonstrates how to access IPN properties with PHP 8.4 Property Hooks
 */

declare(strict_types=1);

require_once __DIR__ . '/../vendor/autoload.php';

use GoSuccess\Digistore24\Ipn\Request;

// Example IPN data
$ipnData = [
    'order_id' => 'ORDER123',
    'product_id' => 12345,
    'product_ids' => '12345,67890,11111', // Comma-separated list
    'coupon_code' => 'SAVE10',
    'tags' => 'premium, vip, annual', // Now comma-separated string
    'license_key' => 'LIC-001-ABC',
    'eticket_url' => 'https://tickets.example.com/1',
    'amount_brutto' => '99.99',
    'email' => 'customer@example.com',
];

$ipn = Request::fromArray($ipnData);

// Access properties directly (no getter methods!)
echo "=== Order Information ===\n";
echo "Order ID: {$ipn->order_id}\n";
echo "Product ID: {$ipn->product_id}\n";
echo "Product IDs: {$ipn->product_ids}\n";
echo "Coupon Code: {$ipn->coupon_code}\n";
echo "License Key: {$ipn->license_key}\n";
echo "E-Ticket URL: {$ipn->eticket_url}\n";
echo "Amount: €{$ipn->amount_brutto}\n";
echo "Email: {$ipn->email}\n";
echo "\n";

// Tags are automatically converted to array!
echo "=== Order Tags (Automatic Array Conversion) ===\n";
$tags = $ipn->tags ?? []; // Array is automatically created from comma-separated string
echo "All tags: " . implode(', ', $tags) . "\n";
echo "First tag: {$tags[0]}\n";
echo "Second tag: {$tags[1]}\n";
echo "Third tag: {$tags[2]}\n";
echo "Total tags: " . count($tags) . "\n";
echo "\n";

// Check if specific tags exist
echo "=== Tag Checks ===\n";
$hasVipTag = in_array('vip', $tags);
$hasPremiumTag = in_array('premium', $tags);
echo "Has VIP tag: " . ($hasVipTag ? 'Yes' : 'No') . "\n";
echo "Has Premium tag: " . ($hasPremiumTag ? 'Yes' : 'No') . "\n";
echo "\n";

// Working with product IDs from comma-separated string
echo "=== Product IDs (Manual Split) ===\n";
if ($ipn->product_ids) {
    $productIdsArray = array_map('intval', explode(',', $ipn->product_ids));
    foreach ($productIdsArray as $index => $productId) {
        echo "Product #" . ($index + 1) . ": $productId\n";
    }
    echo "Total products: " . count($productIdsArray) . "\n";
}
echo "\n";

// Automatic type conversions
echo "=== Automatic Type Conversions ===\n";
echo "Amount (float): " . var_export($ipn->amount_brutto, true) . "\n";
echo "Product ID (int): " . var_export($ipn->product_id, true) . "\n";
echo "Product IDs (string): " . var_export($ipn->product_ids, true) . "\n";
echo "Tags (array): " . var_export($ipn->tags, true) . "\n";

/* Output:
=== Order Information ===
Order ID: ORDER123
Product ID: 12345
Product IDs: 12345,67890,11111
Coupon Code: SAVE10
License Key: LIC-001-ABC
E-Ticket URL: https://tickets.example.com/1
Amount: €99.99
Email: customer@example.com

=== Order Tags (Automatic Array Conversion) ===
All tags: premium, vip, annual
First tag: premium
Second tag: vip
Third tag: annual
Total tags: 3

=== Tag Checks ===
Has VIP tag: Yes
Has Premium tag: Yes

=== Product IDs (Manual Split) ===
Product #1: 12345
Product #2: 67890
Product #3: 11111
Total products: 3

=== Automatic Type Conversions ===
Amount (float): 99.99
Product ID (int): 12345
Product IDs (string): '12345,67890,11111'
Tags (array): array (
  0 => 'premium',
  1 => 'vip',
  2 => 'annual',
)
*/
