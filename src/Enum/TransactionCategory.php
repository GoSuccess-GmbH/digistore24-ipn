<?php

declare(strict_types=1);

namespace GoSuccess\Digistore24\Ipn\Enum;

use GoSuccess\Digistore24\Ipn\Contract\StringBackedEnum;
use GoSuccess\Digistore24\Ipn\Trait\StringBackedEnumTrait;

/**
 * Enum representing various transaction categories.
 *
 * This enum defines the categories that can be used for transactions,
 * such as orders, affiliations, e-tickets, custom forms, and order forms.
 */
enum TransactionCategory: string implements StringBackedEnum
{
    use StringBackedEnumTrait;

    /**
     * Category for orders.
     */
    case ORDERS = 'orders';

    /**
     * Category for affiliations.
     */
    case AFFILIATIONS = 'affiliations';

    /**
     * Category for e-tickets.
     */
    case ETICKETS = 'etickets';

    /**
     * Category for custom forms.
     */
    case CUSTOMFORMS = 'customforms';

    /**
     * Category for order forms.
     */
    case ORDERFORM = 'orderform';

    public function label(): string
    {
        return match ($this) {
            self::ORDERS => 'Orders',
            self::AFFILIATIONS => 'Affiliations',
            self::ETICKETS => 'E-Tickets',
            self::CUSTOMFORMS => 'Custom Forms',
            self::ORDERFORM => 'Order Form',
        };
    }
}
