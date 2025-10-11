<?php

/**
 * Generator script to create IPNRequestDto with Property Hooks
 * This script reads properties from backup and converts them to use PHP 8.4 Property Hooks
 */

// Read the current backup to get all property names and types
$backup = file_get_contents('src/Dto/IPNRequestDto.php.backup');

// Extract public properties with regex
preg_match_all('/public\s+\?([^\s]+)\s+\$(\w+)\s*=\s*null;/m', $backup, $matches, PREG_SET_ORDER);

$properties = [];
foreach ($matches as $match) {
    $properties[] = [
        'type' => $match[1],
        'name' => $match[2],
    ];
}

echo "Found " . count($properties) . " properties\n";

// Generate the new file
$output = <<<'PHP'
<?php

declare(strict_types=1);

namespace GoSuccess\Digistore24IPN\Dto;

use DateTimeImmutable;
use GoSuccess\Digistore24IPN\Enum\Action;
use GoSuccess\Digistore24IPN\Enum\AddressCharacterType;
use GoSuccess\Digistore24IPN\Enum\BillingStatus;
use GoSuccess\Digistore24IPN\Enum\BillingStopReason;
use GoSuccess\Digistore24IPN\Enum\BillingType;
use GoSuccess\Digistore24IPN\Enum\ConnectionType;
use GoSuccess\Digistore24IPN\Enum\Event;
use GoSuccess\Digistore24IPN\Enum\NewsletterSendingPolicy;
use GoSuccess\Digistore24IPN\Enum\OrderType;
use GoSuccess\Digistore24IPN\Enum\PayMethod;
use GoSuccess\Digistore24IPN\Enum\ProductDeliveryType;
use GoSuccess\Digistore24IPN\Enum\SuccessDetectionType;
use GoSuccess\Digistore24IPN\Enum\TransactionCategory;
use GoSuccess\Digistore24IPN\Enum\TransactionType;
use GoSuccess\Digistore24IPN\Enum\UpgradeType;

/**
 * Data Transfer Object for handling IPN requests from Digistore24.
 *
 * This class uses PHP 8.4 Property Hooks for automatic type conversion.
 * All property names match the exact Digistore24 IPN field names (snake_case).
 */
final class IPNRequestDto
{

PHP;

// Type conversion logic for set hooks
$enumTypes = [
    'Action', 'AddressCharacterType', 'BillingStatus', 'BillingStopReason', 'BillingType',
    'ConnectionType', 'Event', 'NewsletterSendingPolicy', 'OrderType', 'PayMethod',
    'ProductDeliveryType', 'SuccessDetectionType', 'TransactionCategory', 
    'TransactionType', 'UpgradeType'
];

foreach ($properties as $prop) {
    $type = $prop['type'];
    $name = $prop['name'];
    
    // Determine set hook logic based on type
    if (in_array($type, $enumTypes)) {
        // Enum conversion
        $setLogic = "$type::from(\$value)";
    } elseif ($type === 'DateTimeImmutable') {
        // DateTime conversion
        $setLogic = "new DateTimeImmutable(\$value)";
    } elseif ($type === 'int') {
        $setLogic = "(int) \$value";
    } elseif ($type === 'float') {
        $setLogic = "(float) \$value";
    } elseif ($type === 'bool') {
        $setLogic = "(bool) \$value";
    } else {
        // string or other
        $setLogic = "\$value";
    }
    
    $output .= "    public ?{$type} \${$name} = null {\n";
    $output .= "        set => \$this->{$name} = \$value !== null ? {$setLogic} : null;\n";
    $output .= "    }\n\n";
}

// Add static helper methods at the end
$output .= <<<'PHP'
    /**
     * Create instance from associative array.
     * With Property Hooks, this is now very simple - just set the properties directly.
     */
    public static function fromArray(array $data): self
    {
        $dto = new self();
        foreach ($data as $key => $value) {
            if (property_exists($dto, $key)) {
                $dto->$key = $value;
            }
        }
        return $dto;
    }

    /**
     * Create instance from POST data.
     */
    public static function fromPost(): self
    {
        return self::fromArray($_POST);
    }

    /**
     * Create instance from GET data.
     */
    public static function fromGet(): self
    {
        return self::fromArray($_GET);
    }
}

PHP;

file_put_contents('src/Dto/IPNRequestDto.php', $output);
echo "Generated new IPNRequestDto.php with " . count($properties) . " properties using Property Hooks\n";
