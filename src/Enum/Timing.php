<?php

declare(strict_types=1);

namespace GoSuccess\Digistore24\Ipn\Enum;

use GoSuccess\Digistore24\Ipn\Contract\StringBackedEnum;
use GoSuccess\Digistore24\Ipn\Trait\StringBackedEnumTrait;

/**
 * Enum representing various timing options for processing IPN requests.
 *
 * This enum defines the timing options that can be used for handling IPN requests,
 * such as before the thank you page and delayed processing.
 */
enum Timing: string implements StringBackedEnum
{
    use StringBackedEnumTrait;

    /**
     * Timing option for processing before the thank you page.
     */
    case BEFORE_THANKYOU = 'before_thankyou';

    /**
     * Timing option for delayed processing.
     */
    case DELAYED = 'delayed';

    public function label(): string
    {
        return match ($this) {
            self::BEFORE_THANKYOU => 'Before Thank You',
            self::DELAYED => 'Delayed',
        };
    }
}
