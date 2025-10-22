<?php

declare(strict_types=1);

namespace GoSuccess\Digistore24\Ipn\Enum;

/**
 * Enum representing various HTTP methods.
 *
 * This enum defines the HTTP methods that can be used in requests,
 * such as GET and POST.
 */
enum HttpMethod: string
{
    /**
     * HTTP GET method.
     */
    case GET = 'GET';

    /**
     * HTTP POST method.
     */
    case POST = 'POST';
}
