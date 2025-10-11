<?php

/**
 * Example: Using Array Helpers
 * 
 * Demonstrates how to use the convenient array helper methods
 * to work with grouped data (coupons, products, tags, etc.)
 */

declare(strict_types=1);

require_once __DIR__ . '/../vendor/autoload.php';

use GoSuccess\Digistore24IPN\Dto\IPNRequestDto;
use GoSuccess\Digistore24IPN\Helper\DtoHelper;

// Example IPN data with multiple products and coupons
$ipnData = [
    'order_id' => 'ORDER123',
    'product_id' => 12345,
    'product_id_2' => 67890,
    'product_id_3' => 11111,
    'coupon_code' => 'SAVE10',
    'coupon_code_2' => 'BONUS20',
    'coupon_amount_left' => '50.00',
    'coupon_amount_left_2' => '25.00',
    'tag1' => 'premium',
    'tag2' => 'vip',
    'tag3' => 'annual',
    'license_key' => 'LIC-001-ABC',
    'license_key_2' => 'LIC-002-XYZ',
    'eticket_url' => 'https://tickets.example.com/1',
    'eticket_url_2' => 'https://tickets.example.com/2',
];

$ipn = DtoHelper::fromArray(IPNRequestDto::class, $ipnData);

// Get all product IDs as array
echo "=== Products in Order ===\n";
$productIds = $ipn->getAllProductIds();
foreach ($productIds as $index => $productId) {
    echo "Product #$index: $productId\n";
}
echo "\n";

// Get all coupon codes
echo "=== Coupon Codes Used ===\n";
$couponCodes = $ipn->getAllCouponCodes();
foreach ($couponCodes as $index => $code) {
    echo "Coupon #$index: $code\n";
}
echo "\n";

// Get remaining coupon amounts
echo "=== Coupon Amounts Left ===\n";
$amountsLeft = $ipn->getAllCouponAmountsLeft();
foreach ($amountsLeft as $index => $amount) {
    echo "Coupon #$index remaining: €$amount\n";
}
echo "\n";

// Get all tags
echo "=== Order Tags ===\n";
$tags = $ipn->getAllTags();
foreach ($tags as $index => $tag) {
    echo "Tag #$index: $tag\n";
}
echo "\n";

// Get all license keys
echo "=== License Keys ===\n";
$licenseKeys = $ipn->getAllLicenseKeys();
foreach ($licenseKeys as $index => $key) {
    echo "License #$index: $key\n";
}
echo "\n";

// Get all e-ticket URLs
echo "=== E-Ticket URLs ===\n";
$eticketUrls = $ipn->getAllEticketUrls();
foreach ($eticketUrls as $index => $url) {
    echo "Ticket #$index: $url\n";
}
echo "\n";

// Check if specific tags exist
echo "=== Tag Checks ===\n";
$hasVipTag = in_array('vip', $tags);
$hasPremiumTag = in_array('premium', $tags);
echo "Has VIP tag: " . ($hasVipTag ? 'Yes' : 'No') . "\n";
echo "Has Premium tag: " . ($hasPremiumTag ? 'Yes' : 'No') . "\n";
echo "\n";

// Count items
echo "=== Summary ===\n";
echo "Total products: " . count($productIds) . "\n";
echo "Total coupons: " . count($couponCodes) . "\n";
echo "Total tags: " . count($tags) . "\n";
echo "Total licenses: " . count($licenseKeys) . "\n";
echo "Total tickets: " . count($eticketUrls) . "\n";

/* Output:
=== Products in Order ===
Product #1: 12345
Product #2: 67890
Product #3: 11111

=== Coupon Codes Used ===
Coupon #1: SAVE10
Coupon #2: BONUS20

=== Coupon Amounts Left ===
Coupon #1 remaining: €50.00
Coupon #2 remaining: €25.00

=== Order Tags ===
Tag #1: premium
Tag #2: vip
Tag #3: annual

=== License Keys ===
License #1: LIC-001-ABC
License #2: LIC-002-XYZ

=== E-Ticket URLs ===
Ticket #1: https://tickets.example.com/1
Ticket #2: https://tickets.example.com/2

=== Tag Checks ===
Has VIP tag: Yes
Has Premium tag: Yes

=== Summary ===
Total products: 3
Total coupons: 2
Total tags: 3
Total licenses: 2
Total tickets: 2
*/
