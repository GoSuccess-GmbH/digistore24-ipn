<?php

declare(strict_types=1);

namespace GoSuccess\Digistore24\Ipn\Enum;

/**
 * Enum representing the newsletter sending policy.
 *
 * This enum defines the policies for sending newsletters based on user opt-in and opt-out status.
 */
enum NewsletterSendingPolicy: string
{
    /**
     * Send newsletter if the user has not opted out.
     */
    case SEND_IF_NOT_OPTOUT = 'send_if_not_optout';

    /**
     * Always send the newsletter.
     */
    case SEND_ALWAYS = 'send_always';

    /**
     * Send newsletter if the user has opted out.
     */
    case SEND_IF_OPTOUT = 'send_if_optout';

    /**
     * Send newsletter if the user has opted in.
     */
    case SEND_IF_OPTIN = 'send_if_optin';
}
