<?php

declare(strict_types=1);

namespace GoSuccess\Digistore24\Ipn\Enum;

/**
 * Enum representing various billing statuses in the Digistore24 IPN system.
 *
 * This enum defines the billing statuses that can be associated with a transaction,
 * such as paying, aborted, unpaid, reminding, and completed.
 */
enum BillingStatus: string
{
    /**
     * Billing status indicating that the transaction is currently being paid.
     */
    case PAYING = 'paying';

    /**
     * Billing status indicating that the transaction has been aborted.
     */
    case ABORTED = 'aborted';

    /**
     * Billing status indicating that the transaction is currently unpaid.
     */
    case UNPAID = 'unpaid';

    /**
     * Billing status indicating that the transaction is currently being reminded.
     */
    case REMINDING = 'reminding';

    /**
     * Billing status indicating that the transaction has been completed.
     */
    case COMPLETED = 'completed';
}
