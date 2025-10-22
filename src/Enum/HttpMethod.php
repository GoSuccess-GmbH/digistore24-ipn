<?php

declare(strict_types=1);

namespace GoSuccess\Digistore24\Ipn\Enum;

use GoSuccess\Digistore24\Ipn\Contract\StringBackedEnum;
use GoSuccess\Digistore24\Ipn\Trait\StringBackedEnumTrait;

/**
 * Enum representing various HTTP methods.
 *
 * This enum defines the HTTP methods that can be used in requests,
 * such as GET and POST.
 */
enum HttpMethod: string implements StringBackedEnum
{
    use StringBackedEnumTrait;

    /**
     * HTTP GET method.
     */
    case GET = 'GET';

    /**
     * HTTP POST method.
     */
    case POST = 'POST';

    public function label(): string
    {
        return match ($this) {
            self::GET => 'GET',
            self::POST => 'POST',
        };
    }
}
