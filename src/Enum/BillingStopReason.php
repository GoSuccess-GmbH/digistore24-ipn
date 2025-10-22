<?php

declare(strict_types=1);

namespace GoSuccess\Digistore24\Ipn\Enum;

use GoSuccess\Digistore24\Ipn\Contract\StringBackedEnum;
use GoSuccess\Digistore24\Ipn\Trait\StringBackedEnumTrait;

/**
 * Enum representing various reasons for stopping billing in the Digistore24 IPN system.
 *
 * This enum defines the reasons that can be associated with stopping billing,
 * such as by operator, by buyer, by refund, by chargeback, and more.
 */
enum BillingStopReason: string implements StringBackedEnum
{
    use StringBackedEnumTrait;

    /**
     * Billing stopped by the operator.
     */
    case BY_OPERATOR = 'by_operator';

    /**
     * Billing stopped by the buyer.
     */
    case BY_BUYER = 'by_buyer';

    /**
     * Billing stopped by refund.
     */
    case BY_REFUND = 'by_refund';

    /**
     * Billing stopped by chargeback.
     */
    case BY_CHARGEBACK = 'by_chargeback';

    /**
     * Billing stopped by payment denial.
     */
    case BY_PAYMENT_DENIAL = 'by_payment_denial';

    /**
     * Billing stopped by payment uncertainty.
     */
    case BY_PAYMENT_UNCERTAIN = 'by_payment_uncertain';

    /**
     * Billing stopped by payment alias invalidation.
     */
    case PAY_ALIAS_INVALID = 'pay_alias_invalid';

    /**
     * Billing stopped by payment alias deletion.
     */
    case UPGRADED = 'upgraded';

    /**
     * Billing stopped due to no product.
     */
    case NO_PRODUCT = 'no_product';

    /**
     * Billing stopped due to merchant inactivity.
     */
    case MERCHANT_INACTIVE = 'merchant_inactive';

    /**
     * Billing stopped for an unknown reason.
     */
    case UNKNOWN = 'unknown';

    public function label(): string
    {
        return match ($this) {
            self::BY_OPERATOR => 'By Operator',
            self::BY_BUYER => 'By Buyer',
            self::BY_REFUND => 'By Refund',
            self::BY_CHARGEBACK => 'By Chargeback',
            self::BY_PAYMENT_DENIAL => 'By Payment Denial',
            self::BY_PAYMENT_UNCERTAIN => 'By Payment Uncertain',
            self::PAY_ALIAS_INVALID => 'Pay Alias Invalid',
            self::UPGRADED => 'Upgraded',
            self::NO_PRODUCT => 'No Product',
            self::MERCHANT_INACTIVE => 'Merchant Inactive',
            self::UNKNOWN => 'Unknown',
        };
    }
}
