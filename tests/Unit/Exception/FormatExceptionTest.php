<?php

declare(strict_types=1);

namespace GoSuccess\Digistore24IPN\Tests\Unit\Exception;

use GoSuccess\Digistore24IPN\Exception\FormatException;
use InvalidArgumentException;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use Throwable;

#[CoversClass(FormatException::class)]
final class FormatExceptionTest extends TestCase
{
    #[Test]
    public function it_can_be_instantiated(): void
    {
        $exception = new FormatException('Test message');

        $this->assertInstanceOf(FormatException::class, $exception);
    }

    #[Test]
    public function it_extends_invalid_argument_exception(): void
    {
        $exception = new FormatException('Test message');

        $this->assertInstanceOf(InvalidArgumentException::class, $exception);
    }

    #[Test]
    public function it_is_throwable(): void
    {
        $exception = new FormatException('Test message');

        $this->assertInstanceOf(Throwable::class, $exception);
    }

    #[Test]
    public function it_stores_message(): void
    {
        $message = 'Invalid format detected';
        $exception = new FormatException($message);

        $this->assertSame($message, $exception->getMessage());
    }

    #[Test]
    public function it_stores_code(): void
    {
        $exception = new FormatException('Test message', 42);

        $this->assertSame(42, $exception->getCode());
    }

    #[Test]
    public function it_stores_previous_exception(): void
    {
        $previous = new InvalidArgumentException('Previous error');
        $exception = new FormatException('Test message', 0, $previous);

        $this->assertSame($previous, $exception->getPrevious());
    }

    #[Test]
    public function it_can_be_caught_as_format_exception(): void
    {
        try {
            throw new FormatException('Test error');
        } catch (FormatException $e) {
            $this->assertSame('Test error', $e->getMessage());
            return;
        }

        $this->fail('FormatException was not caught');
    }

    #[Test]
    public function it_can_be_caught_as_invalid_argument_exception(): void
    {
        try {
            throw new FormatException('Test error');
        } catch (InvalidArgumentException $e) {
            $this->assertInstanceOf(FormatException::class, $e);
            return;
        }

        $this->fail('Exception was not caught as InvalidArgumentException');
    }

    #[Test]
    public function it_can_be_caught_as_throwable(): void
    {
        try {
            throw new FormatException('Test error');
        } catch (Throwable $e) {
            $this->assertInstanceOf(FormatException::class, $e);
            return;
        }

        $this->fail('Exception was not caught as Throwable');
    }

    #[Test]
    public function it_has_stack_trace(): void
    {
        $exception = new FormatException('Test message');
        $trace = $exception->getTrace();

        $this->assertIsArray($trace);
    }

    #[Test]
    public function it_has_file_and_line(): void
    {
        $exception = new FormatException('Test message');

        $this->assertIsString($exception->getFile());
        $this->assertIsInt($exception->getLine());
        $this->assertGreaterThan(0, $exception->getLine());
    }

    #[Test]
    public function it_converts_to_string(): void
    {
        $exception = new FormatException('Test message');
        $string = (string) $exception;

        $this->assertStringContainsString('FormatException', $string);
        $this->assertStringContainsString('Test message', $string);
    }
}
