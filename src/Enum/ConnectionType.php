<?php

declare(strict_types=1);

namespace GoSuccess\Digistore24\Ipn\Enum;

use GoSuccess\Digistore24\Ipn\Contract\StringBackedEnum;
use GoSuccess\Digistore24\Ipn\Trait\StringBackedEnumTrait;

/**
 * Enum representing various connection types in the Digistore24 IPN system.
 *
 * This enum defines the types of connections that can be used for
 * handling IPN requests, such as generic, webhook, and server-to-server postback.
 */
enum ConnectionType: string implements StringBackedEnum
{
    use StringBackedEnumTrait;

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

    public function label(): string
    {
        return match ($this) {
            self::GENERIC => 'Generic',
            self::WEBHOOK => 'Webhook',
            self::S2S_POSTBACK => 'S2S Postback',
        };
    }
}
