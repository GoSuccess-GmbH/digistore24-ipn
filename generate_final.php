<?php

/**
 * Generator script to create IPNRequestDto with Property Hooks
 * Reads from original git version and filters out numbered variants (_2 to _100)
 */

// Read the backup - this is the cleaned-up version without numbered variants
$content = file_get_contents('src/Dto/IPNRequestDto.php.backup');

// Parse public properties from backup (already cleaned up)
preg_match_all('/public\s+\?([^\s]+)\s+\$(\w+)\s*=\s*null;/m', $content, $matches, PREG_SET_ORDER);

$properties = [];
foreach ($matches as $match) {
    $properties[] = [
        'type' => $match[1],
        'name' => $match[2],
    ];
}

echo "Found " . count($properties) . " properties from cleaned backup\n";

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
        // DateTime conversion - handle both ATOM format and regular strings
        $setLogic = "DateTimeImmutable::createFromFormat(DATE_ATOM, \$value) ?: new DateTimeImmutable(\$value)";
    } elseif ($type === 'int') {
        $setLogic = "(int) \$value";
    } elseif ($type === 'float') {
        $setLogic = "(float) \$value";
    } elseif ($type === 'bool') {
        // Use same boolean parsing as DtoHelper
        $setLogic = "self::parseBool(\$value)";
    } else {
        // string or other
        $setLogic = "\$value";
    }
    
    // Use short arrow syntax for set hook (transparent backed property)
    $output .= "    public ?{$type} \${$name} = null {\n";
    $output .= "        set(mixed \$value) => \$value !== null ? {$setLogic} : null;\n";
    $output .= "    }\n\n";
}

// Add static helper methods at the end
$output .= <<<'PHP'
    /**
     * Parse boolean value similar to DtoHelper logic.
     */
    private static function parseBool(mixed $value): ?bool
    {
        $trueValues = ['1', 1, 'Y', 'y', 'yes', 'YES', 'Yes', 'T', 't', 'true', 'TRUE', 'True'];
        $falseValues = ['0', 0, 'N', 'n', 'no', 'NO', 'No', 'F', 'f', 'false', 'FALSE', 'False'];

        if (in_array($value, $trueValues, true)) {
            return true;
        }

        if (in_array($value, $falseValues, true)) {
            return false;
        }
        
        return null;
    }

    /**
     * Create instance from associative array.
     * With Property Hooks, this is now very simple - just set the properties directly.
     * The set hooks handle all type conversion automatically.
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
echo "All properties have snake_case names matching Digistore24 IPN exactly.\n";
echo "Type conversion is handled automatically in Property Hooks set methods.\n";
