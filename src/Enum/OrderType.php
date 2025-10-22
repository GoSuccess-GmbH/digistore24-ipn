<?php

declare(strict_types=1);

namespace GoSuccess\Digistore24\Ipn\Enum;

use GoSuccess\Digistore24\Ipn\Contract\StringBackedEnum;
use GoSuccess\Digistore24\Ipn\Trait\StringBackedEnumTrait;

/**
 * Enum representing various order types.
 *
 * This enum defines the types of orders that can be processed,
 * such as one-time purchases, subscriptions, and trials.
 */
enum OrderType: string implements StringBackedEnum
{
    use StringBackedEnumTrait;

    /**
     * Order type for one-time purchases.
     */
    case REGULAR = 'regular';

    /**
     * Order type for upgrades.
     */
    case UPGRADE = 'upgrade';

    /**
     * Order type for phone orders.
     */
    case PHONE_ORDER = 'phone_order';

    /**
     * Order type for cart actions.
     */
    case CART = 'cart';

    /**
     * Order type for VAT changes.
     */
    case VAT_CHANGE = 'vat_change';

    public function label(): string
    {
        return match ($this) {
            self::REGULAR => 'Regular',
            self::UPGRADE => 'Upgrade',
            self::PHONE_ORDER => 'Phone Order',
            self::CART => 'Cart',
            self::VAT_CHANGE => 'VAT Change',
        };
    }
}
