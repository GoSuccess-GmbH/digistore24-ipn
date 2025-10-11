<?php

declare(strict_types=1);

namespace GoSuccess\Digistore24IPN\Helper;

/**
 * Helper class for creating Data Transfer Objects (DTOs) from arrays or request data.
 *
 * With PHP 8.4 Property Hooks, this helper is now extremely simple.
 * All type conversion is handled automatically by the Property Hooks in the DTO classes.
 * 
 * BREAKING CHANGE: No fallback for old DTOs - requires PHP 8.4 Property Hooks.
 */
final class DtoHelper
{
    /**
     * Creates an instance of the specified DTO class from an associative array.
     *
     * Thanks to Property Hooks, we just set properties directly and they handle
     * all type conversion (int, float, bool, DateTime, Enum) automatically.
     *
     * @param string $dtoClass The fully qualified class name of the DTO.
     * @param array $data The associative array containing data to populate the DTO.
     * @return object An instance of the specified DTO class.
     */
    public static function fromArray(string $dtoClass, array $data): object
    {
        return $dtoClass::fromArray($data);
    }

    /**
     * Creates an instance of the specified DTO class from POST data.
     *
     * @param string $dtoClass The fully qualified class name of the DTO.
     * @return object An instance of the specified DTO class populated with POST data.
     */
    public static function fromPost(string $dtoClass): object
    {
        return self::fromArray($dtoClass, $_POST);
    }

    /**
     * Creates an instance of the specified DTO class from GET data.
     *
     * @param string $dtoClass The fully qualified class name of the DTO.
     * @return object An instance of the specified DTO class populated with GET data.
     */
    public static function fromGet(string $dtoClass): object
    {
        return self::fromArray($dtoClass, $_GET);
    }

    /**
     * Creates an instance of the specified DTO class from the current request data.
     *
     * @param string $dtoClass The fully qualified class name of the DTO.
     * @return object An instance of the specified DTO class populated with request data.
     */
    public static function fromRequest(string $dtoClass): object
    {
        return match (true) {
            !empty($_POST) => self::fromArray($dtoClass, $_POST),
            !empty($_GET) => self::fromArray($dtoClass, $_GET),
            default => self::fromArray($dtoClass, []),
        };
    }
}
