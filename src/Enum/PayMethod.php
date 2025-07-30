<?php

declare(strict_types=1);

namespace GoSuccess\Digistore24IPN\Enum;

/**
 * Enum representing various payment methods.
 *
 * This enum defines the payment methods that can be used in transactions,
 * such as credit cards, PayPal, and bank transfers.
 */
enum PayMethod: string
{
    /**
     * Payment method for credit cards.
     */
    case TEST = 'test';

    /**
     * Payment method for PayPal.
     */
    case PAYPAL = 'paypal';

    /**
     * Payment method for Sezzle.
     */
    case SEZZLE = 'sezzle';

    /**
     * Payment method for credit cards.
     */
    case CREDITCARD = 'creditcard';

    /**
     * Payment method for ELV.
     */
    case ELV = 'ELV';

    /**
     * Payment method for direct debit.
     */
    case BANKTRANSFER = 'banktransfer';

    /**
     * Payment method for direct debit.
     */
    case KLARNA = 'klarna';
}
