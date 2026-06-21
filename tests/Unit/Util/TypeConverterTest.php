<?php

declare(strict_types=1);

namespace GoSuccess\Digistore24\Ipn\Tests\Unit\Util;

use DateTimeImmutable;
use GoSuccess\Digistore24\Ipn\Enum\Salutation;
use GoSuccess\Digistore24\Ipn\Util\TypeConverter;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

#[CoversClass(TypeConverter::class)]
final class TypeConverterTest extends TestCase
{
    /**
     * @return iterable<string, array{mixed, float|null}>
     */
    public static function floatProvider(): iterable
    {
        yield 'numeric string' => ['49.99', 49.99];
        yield 'negative string' => ['-0.95', -0.95];
        yield 'integer string' => ['100', 100.0];
        yield 'float' => [12.5, 12.5];
        yield 'int' => [7, 7.0];
        yield 'true' => [true, 1.0];
        yield 'false (empty rule)' => [false, null];
        yield 'null' => [null, null];
        yield 'empty string' => ['', null];
        yield 'non-numeric string' => ['abc', null];
    }

    #[Test]
    #[DataProvider('floatProvider')]
    public function it_converts_to_float(mixed $input, ?float $expected): void
    {
        self::assertSame($expected, TypeConverter::toFloat($input));
    }

    /**
     * @return iterable<string, array{mixed, int|null}>
     */
    public static function intProvider(): iterable
    {
        yield 'numeric string' => ['123', 123];
        yield 'negative' => ['-5', -5];
        yield 'float string truncates' => ['12.9', 12];
        yield 'int' => [42, 42];
        yield 'float' => [9.7, 9];
        yield 'true' => [true, 1];
        yield 'null' => [null, null];
        yield 'empty string' => ['', null];
        yield 'non-numeric (e.g. TXN id)' => ['TXN-999', null];
    }

    #[Test]
    #[DataProvider('intProvider')]
    public function it_converts_to_int(mixed $input, ?int $expected): void
    {
        self::assertSame($expected, TypeConverter::toInt($input));
    }

    /**
     * @return iterable<string, array{mixed, bool|null}>
     */
    public static function boolProvider(): iterable
    {
        // Digistore24 boolean spec: TRUE = 1,Y,yes,T,true / FALSE = 0,N,no,F,false
        yield 'Y' => ['Y', true];
        yield 'yes' => ['yes', true];
        yield 'T' => ['T', true];
        yield 'true' => ['true', true];
        yield '1' => ['1', true];
        yield 'uppercase YES' => ['YES', true];
        yield 'padded y' => [' y ', true];
        yield 'N' => ['N', false];
        yield 'no' => ['no', false];
        yield 'F' => ['F', false];
        yield 'false' => ['false', false];
        yield '0' => ['0', false];
        yield 'real bool true' => [true, true];
        yield 'real bool false' => [false, false];
        yield 'null' => [null, null];
        yield 'empty string' => ['', null];
        yield 'unknown value' => ['maybe', null];
    }

    #[Test]
    #[DataProvider('boolProvider')]
    public function it_converts_to_bool(mixed $input, ?bool $expected): void
    {
        self::assertSame($expected, TypeConverter::toBool($input));
    }

    #[Test]
    public function it_converts_valid_datetime(): void
    {
        $result = TypeConverter::toDateTime('2026-06-21 17:20:41');

        self::assertInstanceOf(DateTimeImmutable::class, $result);
        self::assertSame('2026-06-21 17:20:41', $result->format('Y-m-d H:i:s'));
    }

    #[Test]
    public function it_passes_through_existing_datetime_instance(): void
    {
        $dt = new DateTimeImmutable('2026-01-01');

        self::assertSame($dt, TypeConverter::toDateTime($dt));
    }

    /**
     * @return iterable<string, array{mixed}>
     */
    public static function invalidDateProvider(): iterable
    {
        yield 'null' => [null];
        yield 'empty string' => [''];
        yield 'ds24 zero date' => ['0000-00-00 00:00:00'];
        yield 'garbage' => ['garbage'];
        yield 'impossible date' => ['2025-13-99'];
    }

    #[Test]
    #[DataProvider('invalidDateProvider')]
    public function it_returns_null_for_invalid_dates(mixed $input): void
    {
        self::assertNull(TypeConverter::toDateTime($input));
    }

    #[Test]
    public function it_throws_for_non_stringable_datetime(): void
    {
        $this->expectException(\InvalidArgumentException::class);

        TypeConverter::toDateTime(['not', 'a', 'date']);
    }

    #[Test]
    public function it_converts_to_enum(): void
    {
        self::assertSame(Salutation::MR, TypeConverter::toEnum(Salutation::class, 'M'));
        self::assertSame(Salutation::MRS, TypeConverter::toEnum(Salutation::class, 'F'));
    }

    #[Test]
    public function it_passes_through_existing_enum_instance(): void
    {
        self::assertSame(
            Salutation::MR,
            TypeConverter::toEnum(Salutation::class, Salutation::MR)
        );
    }

    #[Test]
    public function it_returns_null_for_invalid_enum_value(): void
    {
        self::assertNull(TypeConverter::toEnum(Salutation::class, 'X'));
        // '' short-circuits to null even though a NONE = '' case exists
        self::assertNull(TypeConverter::toEnum(Salutation::class, ''));
        self::assertNull(TypeConverter::toEnum(Salutation::class, null));
    }

    #[Test]
    public function it_splits_comma_separated_string_to_array(): void
    {
        self::assertSame(['vip', 'premium', 'early'], TypeConverter::toArray('vip,premium,early'));
    }

    #[Test]
    public function it_trims_and_filters_empty_array_items(): void
    {
        self::assertSame(['a', 'b'], TypeConverter::toArray(' a , , b ,'));
    }

    #[Test]
    public function it_returns_empty_array_for_empty_input(): void
    {
        self::assertSame([], TypeConverter::toArray(''));
        self::assertSame([], TypeConverter::toArray(null));
    }

    #[Test]
    public function it_normalizes_array_input_to_strings(): void
    {
        self::assertSame(['1', '2', '3'], TypeConverter::toArray([1, 2, 3]));
    }
}
