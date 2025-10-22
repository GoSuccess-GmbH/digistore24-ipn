<?php

declare(strict_types=1);

namespace GoSuccess\Digistore24\Ipn\Enum;

use GoSuccess\Digistore24\Ipn\Contract\StringBackedEnum;
use GoSuccess\Digistore24\Ipn\Trait\StringBackedEnumTrait;

/**
 * Enum representing various transaction types.
 *
 * This enum defines the types of transactions that can occur,
 * such as payments, refunds, chargebacks, and more.
 */
enum TransactionType: string implements StringBackedEnum
{
    use StringBackedEnumTrait;

    /**
     * Represents all transaction types.
     */
    case ALL = 'all';

    /**
     * Represents a payment transaction.
     */
    case PAYMENT = 'payment';

    /**
     * Represents a refund transaction.
     */
    case REFUND = 'refund';

    /**
     * Represents a chargeback transaction.
     */
    case CHARGEBACK = 'chargeback';

    /**
     * Represents a cancellation transaction.
     */
    case PAYMENT_MISSED = 'payment_missed';

    /**
     * Represents a payment denial transaction.
     */
    case PAYMENT_DENIAL = 'payment_denial';

    /**
     * Represents a transaction for a new subscription.
     */
    case REBILL_CANCELLED = 'rebill_cancelled';

    /**
     * Represents a transaction for a subscription that has been paused.
     */
    case REBILL_RESUMED = 'rebill_resumed';

    /**
     * Represents the last paid day of a subscription.
     */
    case LAST_PAID_DAY = 'last_paid_day';

    public function label(): string
    {
        return match ($this) {
            self::ALL => 'All',
            self::PAYMENT => 'Payment',
            self::REFUND => 'Refund',
            self::CHARGEBACK => 'Chargeback',
            self::PAYMENT_MISSED => 'Payment Missed',
            self::PAYMENT_DENIAL => 'Payment Denial',
            self::REBILL_CANCELLED => 'Rebill Cancelled',
            self::REBILL_RESUMED => 'Rebill Resumed',
            self::LAST_PAID_DAY => 'Last Paid Day',
        };
    }
}
