<?php

declare(strict_types=1);

namespace GoSuccess\Digistore24IPN\Helper;

use DateTime;
use DateTimeImmutable;
use ReflectionClass;
use ReflectionNamedType;

/**
 * Helper class for creating Data Transfer Objects (DTOs) from arrays or request data.
 *
 * This class provides methods to instantiate DTOs from associative arrays,
 * POST data, GET data, or the current request data.
 */
final class DtoHelper
{
    /**
     * Creates an instance of the specified DTO class from an associative array.
     *
     * @param string $dtoClass The fully qualified class name of the DTO.
     * @param array $data The associative array containing data to populate the DTO.
     * @return object An instance of the specified DTO class.
     */
    public static function fromArray(string $dtoClass, array $data): object
    {
        $reflection = new ReflectionClass($dtoClass);
        $constructor = $reflection->getConstructor();
        $parameters = $constructor->getParameters();

        $args = [];

        foreach ($parameters as $parameter) {
            $name = $parameter->getName();

            if (array_key_exists($name, $data)) {
                $type = $parameter->getType();

                if ($type instanceof ReflectionNamedType) {
                    $typeName = $type->getName();

                    if (enum_exists($typeName)) {
                        $args[] = $typeName::from($data[$name]);
                        continue;
                    }

                    $args[] = match ($typeName) {
                        'int' => (int) $data[$name],
                        'float' => (float) $data[$name],
                        'bool' => self::parseBoolean($data[$name]),
                        DateTime::class, DateTimeImmutable::class => $typeName::createFromFormat(DATE_ATOM, $data[$name]) ?: new $typeName($data[$name]),
                        default => $data[$name],
                    };
                } else {
                    $args[] = $data[$name];
                }
            } else {
                $args[] = null;
            }
        }

        return new $dtoClass(...$args);
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

    /**
     * Parses a value into a boolean, returning null if the value is not a valid boolean representation.
     *
     * @param mixed $value The value to parse.
     * @return bool|null Returns true for truthy values, false for falsy values, or null if the value is not recognized.
     */
    private static function parseBoolean(mixed $value): ?bool
    {
        $trueValues = ['1', 1, 'Y', 'y', 'yes', 'YES', 'Yes', 'T', 't', 'true', 'TRUE', 'True'];
        $falseValues = ['0', 0, 'N', 'n', 'no', 'NO', 'No', 'F', 'f', 'false', 'FALSE', 'False'];

        if (in_array($value, $trueValues, true)) {
            return true;
        }

        if (in_array($value, $falseValues, true)) {
            return false;
        }
        
        return null;
    }
}
