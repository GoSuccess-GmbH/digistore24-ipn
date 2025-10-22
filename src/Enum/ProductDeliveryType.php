<?php

declare(strict_types=1);

namespace GoSuccess\Digistore24\Ipn\Enum;

use GoSuccess\Digistore24\Ipn\Contract\StringBackedEnum;
use GoSuccess\Digistore24\Ipn\Trait\StringBackedEnumTrait;

/**
 * Enum representing various product delivery types.
 *
 * This enum defines the delivery methods available for products,
 * such as digital downloads, physical shipping, and subscriptions.
 */
enum ProductDeliveryType: string implements StringBackedEnum
{
    use StringBackedEnumTrait;

    /**
     * Delivery type for digital products.
     */
    case DIGITAL = 'digital';

    /**
     * Delivery type for physical products.
     */
    case SHIPPING = 'shipping';

    public function label(): string
    {
        return match ($this) {
            self::DIGITAL => 'Digital',
            self::SHIPPING => 'Shipping',
        };
    }
}
