<?php

declare(strict_types=1);

namespace GoSuccess\Digistore24\Ipn\Enum;

/**
 * Enum representing the success detection type.
 *
 * This enum defines the types of success detection that can be used,
 * such as text-based and HTTP code-based detection.
 */
enum SuccessDetectionType: string
{
    /**
     * Text-based success detection.
     */
    case TEXT = 'OK';

    /**
     * HTTP code-based success detection.
     */
    case HTTP_CODE = '200';
}
