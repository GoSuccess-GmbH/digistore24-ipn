<?php

declare(strict_types=1);

namespace GoSuccess\Digistore24IPN\Enum;

/**
 * Enum representing various reasons for stopping billing in the Digistore24 IPN system.
 *
 * This enum defines the reasons that can be associated with stopping billing,
 * such as by operator, by buyer, by refund, by chargeback, and more.
 */
enum BillingStopReason: string
{
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
}
