<?php

declare(strict_types=1);

namespace GoSuccess\Digistore24\Ipn\Enum;

/**
 * Enum representing various order types.
 *
 * This enum defines the types of orders that can be processed,
 * such as one-time purchases, subscriptions, and trials.
 */
enum OrderType: string
{
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
}
