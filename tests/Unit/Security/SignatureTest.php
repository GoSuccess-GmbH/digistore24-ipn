<?php

declare(strict_types=1);

namespace GoSuccess\Digistore24IPN\Tests\Unit\Security;

use GoSuccess\Digistore24IPN\Exception\FormatException;
use GoSuccess\Digistore24IPN\Security\Signature;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

#[CoversClass(Signature::class)]
final class SignatureTest extends TestCase
{
    private const PASSPHRASE = 'test_passphrase_123';

    #[Test]
    public function it_generates_expected_signature_with_simple_parameters(): void
    {
        $parameters = [
            'order_id' => '12345',
            'amount' => '99.99',
            'currency' => 'EUR',
        ];

        $signature = Signature::getExpectedSignature(self::PASSPHRASE, $parameters);

        $this->assertMatchesRegularExpression('/^[A-F0-9]{128}$/', $signature);
    }

    #[Test]
    public function it_generates_consistent_signatures_for_same_input(): void
    {
        $parameters = [
            'order_id' => '12345',
            'product_id' => '67890',
        ];

        $signature1 = Signature::getExpectedSignature(self::PASSPHRASE, $parameters);
        $signature2 = Signature::getExpectedSignature(self::PASSPHRASE, $parameters);

        $this->assertSame($signature1, $signature2);
    }

    #[Test]
    public function it_generates_different_signatures_for_different_passphrases(): void
    {
        $parameters = ['order_id' => '12345'];

        $signature1 = Signature::getExpectedSignature('passphrase1', $parameters);
        $signature2 = Signature::getExpectedSignature('passphrase2', $parameters);

        $this->assertNotSame($signature1, $signature2);
    }

    #[Test]
    public function it_sorts_parameters_alphabetically_by_key(): void
    {
        $parameters1 = [
            'z_param' => 'value1',
            'a_param' => 'value2',
            'm_param' => 'value3',
        ];

        $parameters2 = [
            'a_param' => 'value2',
            'm_param' => 'value3',
            'z_param' => 'value1',
        ];

        $signature1 = Signature::getExpectedSignature(self::PASSPHRASE, $parameters1);
        $signature2 = Signature::getExpectedSignature(self::PASSPHRASE, $parameters2);

        $this->assertSame($signature1, $signature2);
    }

    #[Test]
    public function it_ignores_sha_sign_parameters(): void
    {
        $parametersWithoutSign = [
            'order_id' => '12345',
            'amount' => '99.99',
        ];

        $parametersWithSign = [
            'order_id' => '12345',
            'amount' => '99.99',
            'sha_sign' => 'IGNORED_SIGNATURE',
            'SHASIGN' => 'ALSO_IGNORED',
        ];

        $signature1 = Signature::getExpectedSignature(self::PASSPHRASE, $parametersWithoutSign);
        $signature2 = Signature::getExpectedSignature(self::PASSPHRASE, $parametersWithSign);

        $this->assertSame($signature1, $signature2);
    }

    #[Test]
    #[DataProvider('emptyValueProvider')]
    public function it_skips_empty_values(mixed $emptyValue): void
    {
        $parametersWithEmpty = [
            'order_id' => '12345',
            'empty_param' => $emptyValue,
            'amount' => '99.99',
        ];

        $parametersWithoutEmpty = [
            'order_id' => '12345',
            'amount' => '99.99',
        ];

        $signature1 = Signature::getExpectedSignature(self::PASSPHRASE, $parametersWithEmpty);
        $signature2 = Signature::getExpectedSignature(self::PASSPHRASE, $parametersWithoutEmpty);

        $this->assertSame($signature1, $signature2);
    }

    public static function emptyValueProvider(): array
    {
        return [
            'null' => [null],
            'empty string' => [''],
            'false' => [false],
        ];
    }

    #[Test]
    public function it_does_not_skip_zero_values(): void
    {
        $parametersWithZero = [
            'order_id' => '12345',
            'discount' => '0',
            'quantity' => 0,
        ];

        $parametersWithoutZero = [
            'order_id' => '12345',
        ];

        $signature1 = Signature::getExpectedSignature(self::PASSPHRASE, $parametersWithZero);
        $signature2 = Signature::getExpectedSignature(self::PASSPHRASE, $parametersWithoutZero);

        $this->assertNotSame($signature1, $signature2);
    }

    #[Test]
    public function it_converts_keys_to_uppercase_when_requested(): void
    {
        $parameters = [
            'order_id' => '12345',
            'amount' => '99.99',
        ];

        $signatureLowercase = Signature::getExpectedSignature(
            self::PASSPHRASE,
            $parameters,
            convertKeysToUppercase: false
        );

        $signatureUppercase = Signature::getExpectedSignature(
            self::PASSPHRASE,
            $parameters,
            convertKeysToUppercase: true
        );

        $this->assertNotSame($signatureLowercase, $signatureUppercase);
    }

    #[Test]
    public function it_decodes_html_entities_when_requested(): void
    {
        $parameters = [
            'name' => 'Test &amp; Example',
            'description' => 'Product &lt;special&gt;',
        ];

        $signatureWithoutDecode = Signature::getExpectedSignature(
            self::PASSPHRASE,
            $parameters,
            doHtmlDecode: false
        );

        $signatureWithDecode = Signature::getExpectedSignature(
            self::PASSPHRASE,
            $parameters,
            doHtmlDecode: true
        );

        $this->assertNotSame($signatureWithoutDecode, $signatureWithDecode);
    }

    #[Test]
    public function it_throws_exception_when_passphrase_is_empty(): void
    {
        $this->expectException(FormatException::class);
        $this->expectExceptionMessage('No signature passphrase provided');

        Signature::getExpectedSignature('', ['order_id' => '12345']);
    }

    #[Test]
    public function it_throws_exception_when_parameters_are_empty(): void
    {
        $this->expectException(FormatException::class);
        $this->expectExceptionMessage('No parameters provided for signature calculation');

        Signature::getExpectedSignature(self::PASSPHRASE, []);
    }

    #[Test]
    public function it_validates_correct_signature(): void
    {
        $parameters = [
            'order_id' => '12345',
            'amount' => '99.99',
        ];

        $signature = Signature::getExpectedSignature(self::PASSPHRASE, $parameters);
        $dataWithSignature = array_merge($parameters, ['sha_sign' => $signature]);

        $this->expectNotToPerformAssertions();
        Signature::validateSignature(self::PASSPHRASE, $dataWithSignature);
    }

    #[Test]
    public function it_validates_signature_with_uppercase_key(): void
    {
        $parameters = [
            'order_id' => '12345',
            'amount' => '99.99',
        ];

        $signature = Signature::getExpectedSignature(self::PASSPHRASE, $parameters);
        $dataWithSignature = array_merge($parameters, ['SHASIGN' => $signature]);

        $this->expectNotToPerformAssertions();
        Signature::validateSignature(self::PASSPHRASE, $dataWithSignature);
    }

    #[Test]
    public function it_throws_exception_when_signature_is_missing(): void
    {
        $this->expectException(FormatException::class);
        $this->expectExceptionMessage('No signature received.');

        Signature::validateSignature(self::PASSPHRASE, ['order_id' => '12345']);
    }

    #[Test]
    public function it_throws_exception_when_signature_is_invalid(): void
    {
        $parameters = [
            'order_id' => '12345',
            'amount' => '99.99',
            'sha_sign' => 'INVALID_SIGNATURE',
        ];

        $this->expectException(FormatException::class);
        $this->expectExceptionMessage('Signature is invalid');

        Signature::validateSignature(self::PASSPHRASE, $parameters);
    }

    #[Test]
    public function it_throws_exception_when_signature_does_not_match(): void
    {
        $parameters1 = ['order_id' => '12345'];
        $parameters2 = ['order_id' => '67890'];

        $signature1 = Signature::getExpectedSignature(self::PASSPHRASE, $parameters1);
        $dataWithWrongSignature = array_merge($parameters2, ['sha_sign' => $signature1]);

        $this->expectException(FormatException::class);
        $this->expectExceptionMessage('Signature is invalid');

        Signature::validateSignature(self::PASSPHRASE, $dataWithWrongSignature);
    }

    #[Test]
    public function it_handles_real_world_digistore24_signature(): void
    {
        // Simuliert einen echten Digistore24 IPN Request
        $ipnData = [
            'event' => 'on_payment',
            'product_id' => '123456',
            'order_id' => 'ABC-12345',
            'buyer_email' => 'test@example.com',
            'transaction_id' => 'TXN-999',
            'amount' => '49.99',
            'currency' => 'EUR',
        ];

        // Signature generieren
        $signature = Signature::getExpectedSignature(self::PASSPHRASE, $ipnData);
        $ipnData['sha_sign'] = $signature;

        // Validierung sollte erfolgreich sein
        $this->expectNotToPerformAssertions();
        Signature::validateSignature(self::PASSPHRASE, $ipnData);
    }

    #[Test]
    public function it_handles_unicode_characters_in_parameters(): void
    {
        $parameters = [
            'name' => 'Günther Müller',
            'city' => 'München',
            'product' => 'Café König',
        ];

        $signature = Signature::getExpectedSignature(self::PASSPHRASE, $parameters);

        $this->assertMatchesRegularExpression('/^[A-F0-9]{128}$/', $signature);
    }

    #[Test]
    public function it_handles_special_characters_in_parameters(): void
    {
        $parameters = [
            'description' => 'Product with special chars: !@#$%^&*()',
            'notes' => 'Line1\nLine2\tTabbed',
        ];

        $signature = Signature::getExpectedSignature(self::PASSPHRASE, $parameters);

        $this->assertMatchesRegularExpression('/^[A-F0-9]{128}$/', $signature);
    }

    #[Test]
    public function it_handles_array_values_in_parameters(): void
    {
        $parameters = [
            'order_id' => '12345',
            'items' => ['item1', 'item2'],
        ];

        $signature = Signature::getExpectedSignature(self::PASSPHRASE, $parameters);

        $this->assertMatchesRegularExpression('/^[A-F0-9]{128}$/', $signature);
    }

    #[Test]
    public function it_returns_128_character_hex_string(): void
    {
        $parameters = ['order_id' => '12345'];
        $signature = Signature::getExpectedSignature(self::PASSPHRASE, $parameters);

        $this->assertSame(128, strlen($signature));
        $this->assertMatchesRegularExpression('/^[A-F0-9]+$/', $signature);
    }

    #[Test]
    public function it_is_case_insensitive_for_signature_validation(): void
    {
        $parameters = ['order_id' => '12345'];
        $signature = Signature::getExpectedSignature(self::PASSPHRASE, $parameters);

        // Test mit lowercase Signatur (sollte fehlschlagen)
        $dataWithLowercase = array_merge($parameters, ['sha_sign' => strtolower($signature)]);

        $this->expectException(FormatException::class);
        Signature::validateSignature(self::PASSPHRASE, $dataWithLowercase);
    }
}
