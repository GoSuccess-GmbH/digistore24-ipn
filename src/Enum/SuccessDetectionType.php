<?php

declare(strict_types=1);

namespace GoSuccess\Digistore24\Ipn\Enum;

use GoSuccess\Digistore24\Ipn\Contract\StringBackedEnum;
use GoSuccess\Digistore24\Ipn\Trait\StringBackedEnumTrait;

/**
 * Enum representing the success detection type.
 *
 * This enum defines the types of success detection that can be used,
 * such as text-based and HTTP code-based detection.
 */
enum SuccessDetectionType: string implements StringBackedEnum
{
    use StringBackedEnumTrait;

    /**
     * Text-based success detection.
     */
    case TEXT = 'OK';

    /**
     * HTTP code-based success detection.
     */
    case HTTP_CODE = '200';

    public function label(): string
    {
        return match ($this) {
            self::TEXT => 'Text (OK)',
            self::HTTP_CODE => 'HTTP Code (200)',
        };
    }
}
