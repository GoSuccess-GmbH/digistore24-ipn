<?php

declare(strict_types=1);

namespace GoSuccess\Digistore24\Ipn\Enum;

use GoSuccess\Digistore24\Ipn\Contract\StringBackedEnum;
use GoSuccess\Digistore24\Ipn\Trait\StringBackedEnumTrait;

/**
 * Enum representing various payment methods.
 *
 * This enum defines the payment methods that can be used in transactions,
 * such as credit cards, PayPal, and bank transfers.
 */
enum PayMethod: string implements StringBackedEnum
{
    use StringBackedEnumTrait;

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

    public function label(): string
    {
        return match ($this) {
            self::TEST => 'Test',
            self::PAYPAL => 'PayPal',
            self::SEZZLE => 'Sezzle',
            self::CREDITCARD => 'Credit Card',
            self::ELV => 'ELV',
            self::BANKTRANSFER => 'Bank Transfer',
            self::KLARNA => 'Klarna',
        };
    }
}
