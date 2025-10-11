<?php

declare(strict_types=1);

namespace GoSuccess\Digistore24IPN\Exception;

use InvalidArgumentException;

/**
 * Exception thrown when the IPN response format is invalid.
 *
 * This exception is used to indicate that the format of the IPN response
 * does not conform to the expected structure or content.
 */
class FormatException extends InvalidArgumentException
{
}
