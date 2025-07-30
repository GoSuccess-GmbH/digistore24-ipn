<?php

declare(strict_types=1);

namespace GoSuccess\Digistore24IPN\Enum;

/**
 * Enum representing various transaction categories.
 *
 * This enum defines the categories that can be used for transactions,
 * such as orders, affiliations, e-tickets, custom forms, and order forms.
 */
enum TransactionCategory: string
{
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
}
