<?php

declare(strict_types=1);

namespace GoSuccess\Digistore24\Ipn\Enum;

/**
 * Enum representing various billing types in the Digistore24 IPN system.
 *
 * This enum defines the different types of billing that can occur,
 * such as one-time payments, subscriptions, and more.
 */
enum BillingType: string
{
    /**
     * Billing type for one-time payments.
     */
    case SINGLE_PAYMENT = 'single_payment';

    /**
     * Billing type for subscriptions.
     */
    case SUBSCRIPTION = 'subscription';

    /**
     * Billing type for installment payments.
     */
    case INSTALLMENT = 'installment';
}
