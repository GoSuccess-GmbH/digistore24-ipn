<?php

declare(strict_types=1);

namespace GoSuccess\Digistore24\Ipn\Enum;

/**
 * Enum representing various connection types in the Digistore24 IPN system.
 *
 * This enum defines the types of connections that can be used for
 * handling IPN requests, such as generic, webhook, and server-to-server postback.
 */
enum ConnectionType: string
{
    /**
     * Generic connection type.
     */
    case GENERIC = 'Generic';

    /**
     * Webhook connection type.
     */
    case WEBHOOK = 'Webhook';

    /**
     * Server-to-server postback connection type.
     */
    case S2S_POSTBACK = 'S2S-Postback';
}
