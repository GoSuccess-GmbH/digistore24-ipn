<?php

declare(strict_types=1);

namespace GoSuccess\Digistore24\Ipn\Tests\Unit;

use GoSuccess\Digistore24\Ipn\Exception\FormatException;
use GoSuccess\Digistore24\Ipn\Response;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

#[CoversClass(Response::class)]
final class ResponseTest extends TestCase
{
    #[Test]
    public function it_creates_minimal_response(): void
    {
        $response = new Response();

        $this->assertSame('OK', $response->toString());
    }

    #[Test]
    public function it_sets_thank_you_url(): void
    {
        $response = new Response();
        $response->thankyouUrl = 'https://example.com/thank-you';

        $expected = "OK\nthankyou_url: https://example.com/thank-you";
        $this->assertSame($expected, $response->toString());
    }

    #[Test]
    public function it_validates_thank_you_url_format(): void
    {
        $response = new Response();

        $this->expectException(FormatException::class);
        $this->expectExceptionMessage('Invalid URL format');

        $response->thankyouUrl = 'not-a-valid-url';
    }

    #[Test]
    public function it_accepts_null_thank_you_url(): void
    {
        $response = new Response();
        $response->thankyouUrl = null;

        $this->assertNull($response->thankyouUrl);
        $this->assertSame('OK', $response->toString());
    }

    #[Test]
    public function it_sets_headline(): void
    {
        $response = new Response();
        $response->headline = 'Welcome to our service!';

        $expected = "OK\nheadline: Welcome to our service!";
        $this->assertSame($expected, $response->toString());
    }

    #[Test]
    public function it_adds_single_login_block(): void
    {
        $response = new Response();
        $response->addLoginBlock('john_doe', 'secret123', 'https://example.com/login');

        $expected = "OK\n"
            . "username: john_doe\n"
            . "password: secret123\n"
            . 'loginurl: https://example.com/login';

        $this->assertSame($expected, $response->toString());
    }

    #[Test]
    public function it_adds_multiple_login_blocks(): void
    {
        $response = new Response();
        $response->addLoginBlock('user1', 'pass1', 'https://example.com/login1');
        $response->addLoginBlock('user2', 'pass2', 'https://example.com/login2');
        $response->addLoginBlock('user3', 'pass3', 'https://example.com/login3');

        $expected = "OK\n"
            . "username: user1\n"
            . "password: pass1\n"
            . "loginurl: https://example.com/login1\n"
            . "username_2: user2\n"
            . "password_2: pass2\n"
            . "loginurl_2: https://example.com/login2\n"
            . "username_3: user3\n"
            . "password_3: pass3\n"
            . 'loginurl_3: https://example.com/login3';

        $this->assertSame($expected, $response->toString());
    }

    #[Test]
    public function it_sets_additional_data(): void
    {
        $response = new Response();
        $response->setAdditionalData('custom_field', 'custom_value');
        $response->setAdditionalData('another_field', 'another_value');

        $output = $response->toString();

        $this->assertStringContainsString('custom_field: custom_value', $output);
        $this->assertStringContainsString('another_field: another_value', $output);
    }

    #[Test]
    public function it_prevents_reserved_key_thankyou_url(): void
    {
        $response = new Response();

        $this->expectException(FormatException::class);
        $this->expectExceptionMessage("Key 'thankyou_url' is reserved");

        $response->setAdditionalData('thankyou_url', 'value');
    }

    #[Test]
    public function it_prevents_reserved_key_headline(): void
    {
        $response = new Response();

        $this->expectException(FormatException::class);
        $this->expectExceptionMessage("Key 'headline' is reserved");

        $response->setAdditionalData('headline', 'value');
    }

    #[Test]
    public function it_prevents_reserved_key_username(): void
    {
        $response = new Response();

        $this->expectException(FormatException::class);
        $this->expectExceptionMessage("Key 'username' is reserved");

        $response->setAdditionalData('username', 'value');
    }

    #[Test]
    public function it_prevents_reserved_key_username_with_number(): void
    {
        $response = new Response();

        $this->expectException(FormatException::class);
        $this->expectExceptionMessage("Key 'username_2' is reserved");

        $response->setAdditionalData('username_2', 'value');
    }

    #[Test]
    public function it_prevents_reserved_key_password(): void
    {
        $response = new Response();

        $this->expectException(FormatException::class);
        $this->expectExceptionMessage("Key 'password' is reserved");

        $response->setAdditionalData('password', 'value');
    }

    #[Test]
    public function it_prevents_reserved_key_loginurl(): void
    {
        $response = new Response();

        $this->expectException(FormatException::class);
        $this->expectExceptionMessage("Key 'loginurl' is reserved");

        $response->setAdditionalData('loginurl', 'value');
    }

    #[Test]
    public function it_creates_complete_response(): void
    {
        $response = new Response();
        $response->thankyouUrl = 'https://example.com/thanks';
        $response->headline = 'Thank you for your purchase!';
        $response->addLoginBlock('customer1', 'pass123', 'https://members.example.com');
        $response->setAdditionalData('order_number', 'ORD-12345');
        $response->setAdditionalData('support_email', 'support@example.com');

        $output = $response->toString();

        $this->assertStringStartsWith('OK', $output);
        $this->assertStringContainsString('thankyou_url: https://example.com/thanks', $output);
        $this->assertStringContainsString('username: customer1', $output);
        $this->assertStringContainsString('password: pass123', $output);
        $this->assertStringContainsString('loginurl: https://members.example.com', $output);
        $this->assertStringContainsString('headline: Thank you for your purchase!', $output);
        $this->assertStringContainsString('order_number: ORD-12345', $output);
        $this->assertStringContainsString('support_email: support@example.com', $output);
    }

    #[Test]
    public function it_handles_special_characters_in_fields(): void
    {
        $response = new Response();
        $response->headline = 'Welcome! You\'re all set.';
        $response->addLoginBlock('user@example.com', 'p@ss&word!', 'https://example.com/login?token=abc123');

        $output = $response->toString();

        $this->assertStringContainsString("headline: Welcome! You're all set.", $output);
        $this->assertStringContainsString('username: user@example.com', $output);
        $this->assertStringContainsString('password: p@ss&word!', $output);
        $this->assertStringContainsString('loginurl: https://example.com/login?token=abc123', $output);
    }

    #[Test]
    public function it_handles_unicode_characters(): void
    {
        $response = new Response();
        $response->headline = 'Willkommen, Günther Müller!';
        $response->addLoginBlock('müller', 'geheim', 'https://example.com/anmeldung');

        $output = $response->toString();

        $this->assertStringContainsString('Willkommen, Günther Müller!', $output);
        $this->assertStringContainsString('müller', $output);
    }

    #[Test]
    public function it_preserves_field_order(): void
    {
        $response = new Response();
        $response->thankyouUrl = 'https://example.com/thanks';
        $response->addLoginBlock('user1', 'pass1', 'https://example.com/login');
        $response->headline = 'Welcome!';
        $response->setAdditionalData('custom', 'value');

        $lines = explode("\n", $response->toString());

        $this->assertSame('OK', $lines[0]);
        $this->assertStringContainsString('thankyou_url:', $lines[1]);
        $this->assertStringContainsString('username:', $lines[2]);
        $this->assertStringContainsString('password:', $lines[3]);
        $this->assertStringContainsString('loginurl:', $lines[4]);
        $this->assertStringContainsString('headline:', $lines[5]);
        $this->assertStringContainsString('custom:', $lines[6]);
    }

    #[Test]
    public function it_accepts_various_valid_url_formats(): void
    {
        $response = new Response();

        $validUrls = [
            'http://example.com',
            'https://example.com',
            'https://sub.example.com',
            'https://example.com:8080',
            'https://example.com/path/to/page',
            'https://example.com/path?query=value',
            'https://example.com/path?query=value&another=test',
            'https://example.com/path#anchor',
            'https://user:pass@example.com',
        ];

        foreach ($validUrls as $url) {
            $response->thankyouUrl = $url;
            $this->assertSame($url, $response->thankyouUrl);
        }
    }

    #[Test]
    public function it_allows_overwriting_thank_you_url(): void
    {
        $response = new Response();
        $response->thankyouUrl = 'https://example.com/thanks1';
        $response->thankyouUrl = 'https://example.com/thanks2';

        $this->assertSame('https://example.com/thanks2', $response->thankyouUrl);
    }

    #[Test]
    public function it_allows_overwriting_headline(): void
    {
        $response = new Response();
        $response->headline = 'First headline';
        $response->headline = 'Second headline';

        $this->assertSame('Second headline', $response->headline);
    }

    #[Test]
    public function it_accumulates_login_blocks(): void
    {
        $response = new Response();
        $response->addLoginBlock('user1', 'pass1', 'url1');

        $output1 = $response->toString();
        $this->assertStringContainsString('username: user1', $output1);

        $response->addLoginBlock('user2', 'pass2', 'url2');

        $output2 = $response->toString();
        $this->assertStringContainsString('username: user1', $output2);
        $this->assertStringContainsString('username_2: user2', $output2);
    }

    #[Test]
    public function it_handles_empty_additional_data(): void
    {
        $response = new Response();
        $response->thankyouUrl = 'https://example.com/thanks';

        $output = $response->toString();

        $this->assertSame("OK\nthankyou_url: https://example.com/thanks", $output);
    }

    #[Test]
    public function it_formats_output_with_newlines(): void
    {
        $response = new Response();
        $response->headline = 'Test';

        $output = $response->toString();

        $this->assertStringContainsString("\n", $output);
        $lines = explode("\n", $output);
        $this->assertGreaterThan(1, count($lines));
    }
}
