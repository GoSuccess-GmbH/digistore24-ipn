<?php

declare(strict_types=1);

namespace GoSuccess\Digistore24\Ipn\Enum;

/**
 * Enum representing various timing options for processing IPN requests.
 *
 * This enum defines the timing options that can be used for handling IPN requests,
 * such as before the thank you page and delayed processing.
 */
enum Timing: string
{
    /**
     * Timing option for processing before the thank you page.
     */
    case BEFORE_THANKYOU = 'before_thankyou';

    /**
     * Timing option for delayed processing.
     */
    case DELAYED = 'delayed';
}
