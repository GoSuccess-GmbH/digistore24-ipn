<?php

/**
 * CORRECT generator - uses original snake_case names from Git
 * Filters out only the numbered variants (_2 to _100)
 */

// Read the original git version with snake_case names
$content = file_get_contents('original_ipnrequest.txt');

// Extract constructor parameters
preg_match('/public function __construct\((.*?)\)/s', $content, $matches);
if (!isset($matches[1])) {
    die("Could not find constructor\n");
}

$constructor = $matches[1];
$lines = explode("\n", $constructor);

$properties = [];
foreach ($lines as $line) {
    $line = trim($line);
    if (empty($line)) continue;
    
    // Match: private ?Type $name = null,
    if (preg_match('/private\s+\?([^\s]+)\s+\$(\w+)\s*=\s*null,?/', $line, $match)) {
        $type = $match[1];
        $name = $match[2];
        
        // Filter out ONLY numbered variants (_2 to _100)
        // Keep the original: coupon_code, custom_1, product_name etc.
        if (preg_match('/_(\d+)$/', $name, $numMatch)) {
            $num = (int)$numMatch[1];
            if ($num >= 2 && $num <= 100) {
                echo "Skipping: $name (numbered variant)\n";
                continue;
            }
        }
        
        $properties[] = [
            'type' => $type,
            'name' => $name,
        ];
    }
}

echo "\nFound " . count($properties) . " properties with CORRECT snake_case names\n\n";

// Generate the file
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
 * 
 * BREAKING CHANGE: No getter methods - use direct property access.
 * Example: $ipn->order_id instead of $ipn->getOrderId()
 */
final class IPNRequestDto
{

PHP;

// Type mapping
$enumTypes = [
    'Action', 'AddressCharacterType', 'BillingStatus', 'BillingStopReason', 'BillingType',
    'ConnectionType', 'Event', 'NewsletterSendingPolicy', 'OrderType', 'PayMethod',
    'ProductDeliveryType', 'SuccessDetectionType', 'TransactionCategory', 
    'TransactionType', 'UpgradeType'
];

foreach ($properties as $prop) {
    $type = $prop['type'];
    $name = $prop['name'];
    
    // Determine set hook logic
    if (in_array($type, $enumTypes)) {
        $setLogic = "$type::from(\$value)";
    } elseif ($type === 'DateTimeImmutable') {
        $setLogic = "DateTimeImmutable::createFromFormat(DATE_ATOM, \$value) ?: new DateTimeImmutable(\$value)";
    } elseif ($type === 'int') {
        $setLogic = "(int) \$value";
    } elseif ($type === 'float') {
        $setLogic = "(float) \$value";
    } elseif ($type === 'bool') {
        $setLogic = "self::parseBool(\$value)";
    } else {
        $setLogic = "\$value";
    }
    
    // Use short arrow syntax for property hooks
    $output .= "    public ?{$type} \${$name} = null {\n";
    $output .= "        set(mixed \$value) => \$value !== null ? {$setLogic} : null;\n";
    $output .= "    }\n\n";
}

// Add helper methods
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
     * Property Hooks handle all type conversion automatically.
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

echo "✅ Generated IPNRequestDto.php with CORRECT snake_case property names!\n";
echo "Properties: " . count($properties) . "\n";
echo "All names match Digistore24 IPN exactly (snake_case)\n";
