<?php

declare(strict_types=1);

namespace GoSuccess\Digistore24\Ipn;

use DateTimeImmutable;
use GoSuccess\Digistore24\Ipn\Enum\Action;
use GoSuccess\Digistore24\Ipn\Enum\BillingStatus;
use GoSuccess\Digistore24\Ipn\Enum\BillingStopReason;
use GoSuccess\Digistore24\Ipn\Enum\BillingType;
use GoSuccess\Digistore24\Ipn\Enum\Event;
use GoSuccess\Digistore24\Ipn\Enum\OrderType;
use GoSuccess\Digistore24\Ipn\Enum\PayMethod;
use GoSuccess\Digistore24\Ipn\Enum\ProductDeliveryType;
use GoSuccess\Digistore24\Ipn\Enum\Salutation;
use GoSuccess\Digistore24\Ipn\Enum\TransactionType;
use GoSuccess\Digistore24\Ipn\Enum\UpgradeType;
use GoSuccess\Digistore24\Ipn\Util\TypeConverter;

/**
 * Data Transfer Object for handling IPN notifications from Digistore24.
 *
 * This class represents the notification data sent by Digistore24 to your webhook endpoint.
 * It uses PHP 8.4 Property Hooks for automatic type conversion and zero-reflection overhead.
 *
 * KEY FEATURES:
 * - All property names match exact Digistore24 IPN field names (snake_case)
 * - Automatic type conversion via Property Hooks (string → int, float, bool, DateTimeImmutable, Enum)
 * - Direct property access (no getter methods needed)
 * - Tags are automatically converted from comma-separated string to array
 *
 * BREAKING CHANGES FROM v1.x:
 * - No getter methods: Use $notification->order_id instead of $notification->getOrderId()
 * - Property names changed to snake_case: order_id instead of orderId
 * - Tags unified: $notification->tags (array) instead of $notification->tag1, $notification->tag2, etc.
 *
 * SECURITY:
 * Always validate signatures before processing IPN data:
 * ```php
 * Signature::validateSignature('your-passphrase', $_POST);
 * $notification = Notification::fromPost();
 * ```
 *
 * @link https://dev.digistore24.com/hc/en-us/articles/32480217565969-Quick-Integration-Guide
 *
 * @example Basic usage:
 * ```php
 * // Create from POST data
 * $notification = Notification::fromPost();
 *
 * // Access properties directly
 * echo $notification->order_id;
 * echo $notification->email;
 * echo $notification->transaction_amount;
 *
 * // Check event type
 * if ($notification->event === Event::ON_PAYMENT) {
 *     // Grant access to product
 * }
 *
 * // Work with arrays
 * foreach ($notification->tags as $tag) {
 *     echo $tag;
 * }
 * ```
 */
final class Notification
{
    public ?Action $action = null {
        set(mixed $value) => TypeConverter::toEnum(Action::class, $value);
    }

    public ?float $amount_affiliate = null {
        set(mixed $value) => $value !== null ? (float) $value : null;
    }

    public ?float $amount_brutto = null {
        set(mixed $value) => $value !== null ? (float) $value : null;
    }

    public ?float $amount_credited = null {
        set(mixed $value) => $value !== null ? (float) $value : null;
    }

    public ?float $amount_fee = null {
        set(mixed $value) => $value !== null ? (float) $value : null;
    }

    public ?float $amount_netto = null {
        set(mixed $value) => $value !== null ? (float) $value : null;
    }

    public ?float $amount_partner = null {
        set(mixed $value) => $value !== null ? (float) $value : null;
    }

    public ?float $amount_payout = null {
        set(mixed $value) => $value !== null ? (float) $value : null;
    }

    public ?float $amount_provider = null {
        set(mixed $value) => $value !== null ? (float) $value : null;
    }

    public ?float $amount_vendor = null {
        set(mixed $value) => $value !== null ? (float) $value : null;
    }

    public ?float $amount_vat = null {
        set(mixed $value) => $value !== null ? (float) $value : null;
    }

    public ?string $address_city = null {
        set(mixed $value) => $value !== null ? $value : null;
    }

    public ?string $address_company = null {
        set(mixed $value) => $value !== null ? $value : null;
    }

    public ?string $address_country = null {
        set(mixed $value) => $value !== null ? $value : null;
    }

    public ?string $address_country_name = null {
        set(mixed $value) => $value !== null ? $value : null;
    }

    public ?string $address_email = null {
        set(mixed $value) => $value !== null ? $value : null;
    }

    public ?string $address_first_name = null {
        set(mixed $value) => $value !== null ? $value : null;
    }

    public ?string $address_id = null {
        set(mixed $value) => $value !== null ? $value : null;
    }

    public ?string $address_last_name = null {
        set(mixed $value) => $value !== null ? $value : null;
    }

    public ?string $address_phone_no = null {
        set(mixed $value) => $value !== null ? $value : null;
    }

    public ?Salutation $address_salutation = null {
        set(mixed $value) => TypeConverter::toEnum(Salutation::class, $value);
    }

    public ?string $address_state = null {
        set(mixed $value) => $value !== null ? $value : null;
    }

    public ?string $address_street = null {
        set(mixed $value) => $value !== null ? $value : null;
    }

    public ?string $address_street2 = null {
        set(mixed $value) => $value !== null ? $value : null;
    }

    public ?string $address_street_name = null {
        set(mixed $value) => $value !== null ? $value : null;
    }

    public ?string $address_street_number = null {
        set(mixed $value) => $value !== null ? $value : null;
    }

    public ?string $address_tax_id = null {
        set(mixed $value) => $value !== null ? $value : null;
    }

    public ?string $address_title = null {
        set(mixed $value) => $value !== null ? $value : null;
    }

    public ?string $address_zipcode = null {
        set(mixed $value) => $value !== null ? $value : null;
    }

    public ?string $affiliate_name = null {
        set(mixed $value) => $value !== null ? $value : null;
    }

    public ?int $affiliate_id = null {
        set(mixed $value) => $value !== null ? (int) $value : null;
    }

    public ?string $affiliate_link = null {
        set(mixed $value) => $value !== null ? $value : null;
    }

    public ?BillingStatus $billing_status = null {
        set(mixed $value) => TypeConverter::toEnum(BillingStatus::class, $value);
    }

    public ?BillingStopReason $billing_stop_reason = null {
        set(mixed $value) => TypeConverter::toEnum(BillingStopReason::class, $value);
    }

    public ?BillingType $billing_type = null {
        set(mixed $value) => TypeConverter::toEnum(BillingType::class, $value);
    }

    public ?int $buyer_id = null {
        set(mixed $value) => $value !== null ? (int) $value : null;
    }

    public ?string $campaignkey = null {
        set(mixed $value) => $value !== null ? $value : null;
    }

    public ?string $country = null {
        set(mixed $value) => $value !== null ? $value : null;
    }

    public ?string $coupon_code = null {
        set(mixed $value) => $value !== null ? $value : null;
    }

    public ?float $coupon_amount_left = null {
        set(mixed $value) => $value !== null ? (float) $value : null;
    }

    public ?float $coupon_amount_total = null {
        set(mixed $value) => $value !== null ? (float) $value : null;
    }

    public ?string $coupon_currency = null {
        set(mixed $value) => $value !== null ? $value : null;
    }

    public ?int $coupon_id = null {
        set(mixed $value) => $value !== null ? (int) $value : null;
    }

    public ?string $currency = null {
        set(mixed $value) => $value !== null ? $value : null;
    }

    public ?string $custom = null {
        set(mixed $value) => $value !== null ? $value : null;
    }

    public ?string $custom_key = null {
        set(mixed $value) => $value !== null ? $value : null;
    }

    public ?string $customer_affiliate_url = null {
        set(mixed $value) => $value !== null ? $value : null;
    }

    public ?string $customer_affiliate_name = null {
        set(mixed $value) => $value !== null ? $value : null;
    }

    public ?string $customer_affiliate_promo_url = null {
        set(mixed $value) => $value !== null ? $value : null;
    }

    public ?string $customer_to_affiliate_url = null {
        set(mixed $value) => $value !== null ? $value : null;
    }

    public ?DateTimeImmutable $delivery_date = null {
        set(mixed $value) => $value !== null ? DateTimeImmutable::createFromFormat(DATE_ATOM, $value) ?: new DateTimeImmutable($value) : null;
    }

    public ?string $email = null {
        set(mixed $value) => $value !== null ? $value : null;
    }

    public ?DateTimeImmutable $eticket_created_at = null {
        set(mixed $value) => $value !== null ? DateTimeImmutable::createFromFormat(DATE_ATOM, $value) ?: new DateTimeImmutable($value) : null;
    }

    public ?int $eticket_count = null {
        set(mixed $value) => $value !== null ? (int) $value : null;
    }

    public ?int $eticket_code = null {
        set(mixed $value) => $value !== null ? (int) $value : null;
    }

    public ?string $eticket_date = null {
        set(mixed $value) => $value !== null ? $value : null;
    }

    public ?string $eticket_hint = null {
        set(mixed $value) => $value !== null ? $value : null;
    }

    public ?int $eticket_id = null {
        set(mixed $value) => $value !== null ? (int) $value : null;
    }

    public ?bool $eticket_is_blocked = null {
        set(mixed $value) => $value !== null ? self::parseBool($value) : null;
    }

    public ?DateTimeImmutable $eticket_modified_at = null {
        set(mixed $value) => $value !== null ? DateTimeImmutable::createFromFormat(DATE_ATOM, $value) ?: new DateTimeImmutable($value) : null;
    }

    public ?int $eticket_no = null {
        set(mixed $value) => $value !== null ? (int) $value : null;
    }

    public ?string $eticket_url = null {
        set(mixed $value) => $value !== null ? $value : null;
    }

    public ?string $eticket_used_at = null {
        set(mixed $value) => $value !== null ? $value : null;
    }

    public ?Event $event = null {
        set(mixed $value) => match (true) {
            $value === null => null,
            $value instanceof Event => $value,
            default => Event::from($value),
        };
    }

    public ?string $event_label = null {
        set(mixed $value) => $value !== null ? $value : null;
    }

    public ?float $first_amount = null {
        set(mixed $value) => $value !== null ? (float) $value : null;
    }

    public ?string $first_billing_interval = null {
        set(mixed $value) => $value !== null ? $value : null;
    }

    public ?float $first_vat_amount = null {
        set(mixed $value) => $value !== null ? (float) $value : null;
    }

    public ?string $form_count = null {
        set(mixed $value) => $value !== null ? $value : null;
    }

    public ?string $form_no = null {
        set(mixed $value) => $value !== null ? $value : null;
    }

    public ?string $ipn_config_api_key_id = null {
        set(mixed $value) => $value !== null ? $value : null;
    }

    public ?int $ipn_config_domain_id = null {
        set(mixed $value) => $value !== null ? (int) $value : null;
    }

    public ?int $ipn_config_id = null {
        set(mixed $value) => $value !== null ? (int) $value : null;
    }

    public ?string $ipn_config_products_ids = null {
        set(mixed $value) => $value !== null ? $value : null;
    }

    public ?float $ipn_version = null {
        set(mixed $value) => $value !== null ? (float) $value : null;
    }

    public ?DateTimeImmutable $is_cancelled_for = null {
        set(mixed $value) => $value !== null ? DateTimeImmutable::createFromFormat(DATE_ATOM, $value) ?: new DateTimeImmutable($value) : null;
    }

    public ?bool $is_gdpr_country = null {
        set(mixed $value) => $value !== null ? self::parseBool($value) : null;
    }

    public ?string $language = null {
        set(mixed $value) => $value !== null ? $value : null;
    }

    public ?string $license_created = null {
        set(mixed $value) => $value !== null ? $value : null;
    }

    public ?string $license_data_email = null {
        set(mixed $value) => $value !== null ? $value : null;
    }

    public ?string $license_data_first_name = null {
        set(mixed $value) => $value !== null ? $value : null;
    }

    public ?string $license_data_last_name = null {
        set(mixed $value) => $value !== null ? $value : null;
    }

    public ?string $license_data_product = null {
        set(mixed $value) => $value !== null ? $value : null;
    }

    public ?string $license_key = null {
        set(mixed $value) => $value !== null ? $value : null;
    }

    public ?string $license_key_type = null {
        set(mixed $value) => $value !== null ? $value : null;
    }

    public ?int $license_id = null {
        set(mixed $value) => $value !== null ? (int) $value : null;
    }

    public ?string $location_address = null {
        set(mixed $value) => $value !== null ? $value : null;
    }

    public ?string $location_country = null {
        set(mixed $value) => $value !== null ? $value : null;
    }

    public ?string $location_directions = null {
        set(mixed $value) => $value !== null ? $value : null;
    }

    public ?int $location_id = null {
        set(mixed $value) => $value !== null ? (int) $value : null;
    }

    public ?string $location_latitude = null {
        set(mixed $value) => $value !== null ? $value : null;
    }

    public ?string $location_longitude = null {
        set(mixed $value) => $value !== null ? $value : null;
    }

    public ?string $location_map_image_url = null {
        set(mixed $value) => $value !== null ? $value : null;
    }

    public ?string $location_name = null {
        set(mixed $value) => $value !== null ? $value : null;
    }

    public ?string $location_note = null {
        set(mixed $value) => $value !== null ? $value : null;
    }

    public ?string $merchant_name = null {
        set(mixed $value) => $value !== null ? $value : null;
    }

    public ?int $merchant_id = null {
        set(mixed $value) => $value !== null ? (int) $value : null;
    }

    public ?DateTimeImmutable $next_payment_at = null {
        set(mixed $value) => $value !== null ? DateTimeImmutable::createFromFormat(DATE_ATOM, $value) ?: new DateTimeImmutable($value) : null;
    }

    public ?string $newsletter_choice = null {
        set(mixed $value) => $value !== null ? $value : null;
    }

    public ?string $newsletter_choice_msg = null {
        set(mixed $value) => $value !== null ? $value : null;
    }

    public ?string $note = null {
        set(mixed $value) => $value !== null ? $value : null;
    }

    public ?int $number_of_installments = null {
        set(mixed $value) => $value !== null ? (int) $value : null;
    }

    public ?BillingStatus $order_billing_status = null {
        set(mixed $value) => TypeConverter::toEnum(BillingStatus::class, $value);
    }

    public ?DateTimeImmutable $order_date = null {
        set(mixed $value) => TypeConverter::toDateTime($value);
    }

    public ?DateTimeImmutable $order_date_time = null {
        set(mixed $value) => TypeConverter::toDateTime($value);
    }

    public ?string $order_details_url = null {
        set(mixed $value) => $value !== null ? $value : null;
    }

    public ?string $order_id = null {
        set(mixed $value) => $value !== null ? $value : null;
    }

    public ?bool $order_is_paid = null {
        set(mixed $value) => $value !== null ? self::parseBool($value) : null;
    }

    public ?string $order_time = null {
        set(mixed $value) => $value !== null ? $value : null;
    }

    public ?OrderType $order_type = null {
        set(mixed $value) => TypeConverter::toEnum(OrderType::class, $value);
    }

    public ?int $orderform_id = null {
        set(mixed $value) => $value !== null ? (int) $value : null;
    }

    public ?float $other_amounts = null {
        set(mixed $value) => $value !== null ? (float) $value : null;
    }

    public ?string $other_billing_intervals = null {
        set(mixed $value) => $value !== null ? $value : null;
    }

    public ?float $other_vat_amounts = null {
        set(mixed $value) => $value !== null ? (float) $value : null;
    }

    public ?PayMethod $pay_method = null {
        set(mixed $value) => TypeConverter::toEnum(PayMethod::class, $value);
    }

    public ?int $pay_sequence_no = null {
        set(mixed $value) => $value !== null ? (int) $value : null;
    }

    public ?int $payplan_id = null {
        set(mixed $value) => $value !== null ? (int) $value : null;
    }

    public ?string $payment_id = null {
        set(mixed $value) => $value !== null ? $value : null;
    }

    public ?ProductDeliveryType $product_delivery_type = null {
        set(mixed $value) => TypeConverter::toEnum(ProductDeliveryType::class, $value);
    }

    public ?float $product_amount = null {
        set(mixed $value) => $value !== null ? (float) $value : null;
    }

    public ?int $product_id = null {
        set(mixed $value) => $value !== null ? (int) $value : null;
    }

    public ?string $product_ids = null {
        set(mixed $value) => $value !== null ? $value : null;
    }

    public ?string $product_language = null {
        set(mixed $value) => $value !== null ? $value : null;
    }

    public ?float $product_netto_amount = null {
        set(mixed $value) => $value !== null ? (float) $value : null;
    }

    public ?string $product_name = null {
        set(mixed $value) => $value !== null ? $value : null;
    }

    public ?float $product_shipping_amount = null {
        set(mixed $value) => $value !== null ? (float) $value : null;
    }

    public ?float $product_txn_amount = null {
        set(mixed $value) => $value !== null ? (float) $value : null;
    }

    public ?float $product_txn_netto_amount = null {
        set(mixed $value) => $value !== null ? (float) $value : null;
    }

    public ?float $product_txn_shipping = null {
        set(mixed $value) => $value !== null ? (float) $value : null;
    }

    public ?float $product_txn_vat_amount = null {
        set(mixed $value) => $value !== null ? (float) $value : null;
    }

    public ?float $product_vat_amount = null {
        set(mixed $value) => $value !== null ? (float) $value : null;
    }

    public ?int $quantity = null {
        set(mixed $value) => $value !== null ? (int) $value : null;
    }

    public ?DateTimeImmutable $rebill_stop_noted_at = null {
        set(mixed $value) => $value !== null ? DateTimeImmutable::createFromFormat(DATE_ATOM, $value) ?: new DateTimeImmutable($value) : null;
    }

    public ?string $rebilling_stop_url = null {
        set(mixed $value) => $value !== null ? $value : null;
    }

    public ?string $receipt_url = null {
        set(mixed $value) => $value !== null ? $value : null;
    }

    public ?string $referring_affiliate_name = null {
        set(mixed $value) => $value !== null ? $value : null;
    }

    public ?string $refund_days = null {
        set(mixed $value) => $value !== null ? $value : null;
    }

    public ?string $renew_url = null {
        set(mixed $value) => $value !== null ? $value : null;
    }

    public ?string $request_refund_url = null {
        set(mixed $value) => $value !== null ? $value : null;
    }

    public ?string $salesteam_name = null {
        set(mixed $value) => $value !== null ? $value : null;
    }

    public ?int $salesteam_id = null {
        set(mixed $value) => $value !== null ? (int) $value : null;
    }

    public ?string $sha_sign = null {
        set(mixed $value) => $value !== null ? $value : null;
    }

    public ?string $SHASIGN = null {
        set(mixed $value) => $value !== null ? $value : null;
    }

    public ?string $support_url = null {
        set(mixed $value) => $value !== null ? $value : null;
    }

    /**
     * Tags as array (converted from comma-separated string).
     * Index starts at 0 (standard PHP array).
     * Example: $dto->tags[0] for first tag, $dto->tags[1] for second tag, etc.
     */
    public ?array $tags = null {
        set(mixed $value) {
            if ($value === null || $value === '') {
                $this->tags = null;

                return;
            }

            // If already an array, use it directly
            if (is_array($value)) {
                /** @var string[] $value */
                $this->tags = array_filter(array_map('trim', $value), fn ($tag) => $tag !== '');

                return;
            }

            // Convert comma-separated string to array
            $this->tags = array_filter(array_map('trim', explode(',', (string) $value)), fn ($tag) => $tag !== '');
        }
    }

    public ?float $transaction_amount = null {
        set(mixed $value) => $value !== null ? (float) $value : null;
    }

    public ?string $transaction_currency = null {
        set(mixed $value) => $value !== null ? $value : null;
    }

    public ?int $transaction_id = null {
        set(mixed $value) => $value !== null ? (int) $value : null;
    }

    public ?DateTimeImmutable $transaction_date = null {
        set(mixed $value) => $value !== null ? DateTimeImmutable::createFromFormat(DATE_ATOM, $value) ?: new DateTimeImmutable($value) : null;
    }

    public ?DateTimeImmutable $transaction_processed_at = null {
        set(mixed $value) => $value !== null ? DateTimeImmutable::createFromFormat(DATE_ATOM, $value) ?: new DateTimeImmutable($value) : null;
    }

    public ?TransactionType $transaction_type = null {
        set(mixed $value) => TypeConverter::toEnum(TransactionType::class, $value);
    }

    public ?string $trackingkey = null {
        set(mixed $value) => $value !== null ? $value : null;
    }

    public ?string $upgrade_key = null {
        set(mixed $value) => $value !== null ? $value : null;
    }

    public ?UpgradeType $upgrade_type = null {
        set(mixed $value) => TypeConverter::toEnum(UpgradeType::class, $value);
    }

    public ?string $upgraded_address_first_name = null {
        set(mixed $value) => $value !== null ? $value : null;
    }

    public ?string $upgraded_address_last_name = null {
        set(mixed $value) => $value !== null ? $value : null;
    }

    public ?int $upgraded_buyer_id = null {
        set(mixed $value) => $value !== null ? (int) $value : null;
    }

    public ?string $upgraded_email = null {
        set(mixed $value) => $value !== null ? $value : null;
    }

    public ?string $upgraded_order_date = null {
        set(mixed $value) => $value !== null ? $value : null;
    }

    public ?string $upgraded_order_date_time = null {
        set(mixed $value) => $value !== null ? $value : null;
    }

    public ?string $upgraded_order_id = null {
        set(mixed $value) => $value !== null ? $value : null;
    }

    public ?string $upgraded_order_paid_until = null {
        set(mixed $value) => $value !== null ? $value : null;
    }

    public ?string $upgraded_order_time = null {
        set(mixed $value) => $value !== null ? $value : null;
    }

    public ?int $upgraded_product_id = null {
        set(mixed $value) => $value !== null ? (int) $value : null;
    }

    public ?string $upgraded_product_name = null {
        set(mixed $value) => $value !== null ? $value : null;
    }

    public ?string $variant_id = null {
        set(mixed $value) => $value !== null ? $value : null;
    }

    public ?string $variant_name = null {
        set(mixed $value) => $value !== null ? $value : null;
    }

    public ?float $vat_rate = null {
        set(mixed $value) => $value !== null ? (float) $value : null;
    }

    public ?string $voucher_code = null {
        set(mixed $value) => $value !== null ? $value : null;
    }

    public ?string $used_coupon_code = null {
        set(mixed $value) => $value !== null ? $value : null;
    }

    public ?int $used_coupon_id = null {
        set(mixed $value) => $value !== null ? (int) $value : null;
    }

    /**
     * Parse boolean values from various string formats.
     *
     * This internal method handles Digistore24's different boolean representations
     * and converts them to proper PHP boolean values.
     *
     * Supported TRUE values: '1', 1, 'Y', 'y', 'yes', 'YES', 'Yes', 'T', 't', 'true', 'TRUE', 'True'
     * Supported FALSE values: '0', 0, 'N', 'n', 'no', 'NO', 'No', 'F', 'f', 'false', 'FALSE', 'False'
     *
     * @param mixed $value The value to parse as boolean
     *
     * @return bool|null The parsed boolean value, or null if not recognized
     *
     * @internal Used by Property Hooks for automatic boolean conversion
     */
    private static function parseBool(mixed $value): ?bool
    {
        // List of values that represent TRUE
        $trueValues = ['1', 1, 'Y', 'y', 'yes', 'YES', 'Yes', 'T', 't', 'true', 'TRUE', 'True'];
        // List of values that represent FALSE
        $falseValues = ['0', 0, 'N', 'n', 'no', 'NO', 'No', 'F', 'f', 'false', 'FALSE', 'False'];

        if (in_array($value, $trueValues, true)) {
            return true;
        }

        if (in_array($value, $falseValues, true)) {
            return false;
        }

        // Return null for unrecognized values
        return null;
    }

    /**
     * Create Notification instance from associative array.
     *
     * This factory method creates a new Notification object and populates it
     * with data from an associative array. Property Hooks automatically handle
     * all type conversions (strings → int, float, bool, DateTimeImmutable, Enums).
     *
     * Only properties that exist in the Notification class will be set.
     * Unknown keys in the input array are safely ignored.
     *
     * @param array<string, mixed> $data Associative array with IPN field names as keys
     *
     * @return self A new Notification instance with populated properties
     *
     * @example
     * ```php
     * $data = [
     *     'order_id' => '12345',
     *     'email' => 'customer@example.com',
     *     'transaction_amount' => '99.00',  // Auto-converted to float
     *     'event' => 'on_payment',          // Auto-converted to Event enum
     *     'tags' => 'vip,premium,early-bird' // Auto-converted to array
     * ];
     * $notification = Notification::fromArray($data);
     * ```
     */
    public static function fromArray(array $data): self
    {
        $dto = new self();
        foreach ($data as $key => $value) {
            // Only set properties that actually exist in the class
            if (property_exists($dto, $key)) {
                $dto->$key = $value; // Property Hook handles type conversion
            }
        }

        return $dto;
    }

    /**
     * Create Notification instance from $_POST superglobal.
     *
     * Convenience method for creating a Notification from POST data.
     * This is the most common way to handle IPN callbacks, as Digistore24
     * typically sends IPN data via POST request.
     *
     * IMPORTANT: Always validate the signature before trusting the data:
     * ```php
     * Signature::validateSignature('your-passphrase', $_POST);
     * $notification = Notification::fromPost();
     * ```
     *
     * @return self A new Notification instance with data from $_POST
     *
     * @example
     * ```php
     * // In your IPN endpoint (e.g., webhook.php)
     * $notification = Notification::fromPost();
     *
     * if ($notification->event === Event::ON_PAYMENT) {
     *     // Process successful payment
     *     echo "Order ID: {$notification->order_id}";
     *     echo "Amount: {$notification->transaction_amount}";
     * }
     * ```
     */
    public static function fromPost(): self
    {
        return self::fromArray($_POST);
    }

    /**
     * Create Notification instance from $_GET superglobal.
     *
     * Convenience method for creating a Notification from GET parameters.
     * Less common than POST, but some IPN configurations may use GET requests.
     *
     * IMPORTANT: Always validate the signature before trusting the data:
     * ```php
     * Signature::validateSignature('your-passphrase', $_GET);
     * $notification = Notification::fromGet();
     * ```
     *
     * @return self A new Notification instance with data from $_GET
     *
     * @example
     * ```php
     * // For GET-based IPN callbacks
     * $notification = Notification::fromGet();
     *
     * // Access the data
     * echo $notification->order_id;
     * ```
     */
    public static function fromGet(): self
    {
        return self::fromArray($_GET);
    }

    // ========================================
    // Convenience Methods
    // ========================================

    /**
     * Check if this is a payment event.
     *
     * @return bool True if event is ON_PAYMENT
     */
    public function isPayment(): bool
    {
        return $this->event === Event::ON_PAYMENT;
    }

    /**
     * Check if this is a refund event.
     *
     * @return bool True if event is ON_REFUND
     */
    public function isRefund(): bool
    {
        return $this->event === Event::ON_REFUND;
    }

    /**
     * Check if this is a chargeback event.
     *
     * @return bool True if event is ON_CHARGEBACK
     */
    public function isChargeback(): bool
    {
        return $this->event === Event::ON_CHARGEBACK;
    }

    /**
     * Check if this is a payment missed event.
     *
     * @return bool True if event is ON_PAYMENT_MISSED
     */
    public function isPaymentMissed(): bool
    {
        return $this->event === Event::ON_PAYMENT_MISSED;
    }

    /**
     * Check if this is a rebill cancelled event.
     *
     * @return bool True if event is ON_REBILL_CANCELLED
     */
    public function isRebillCancelled(): bool
    {
        return $this->event === Event::ON_REBILL_CANCELLED;
    }

    /**
     * Check if this is a rebill resumed event.
     *
     * @return bool True if event is ON_REBILL_RESUMED
     */
    public function isRebillResumed(): bool
    {
        return $this->event === Event::ON_REBILL_RESUMED;
    }

    /**
     * Check if this is the last paid day event.
     *
     * @return bool True if event is LAST_PAID_DAY
     */
    public function isLastPaidDay(): bool
    {
        return $this->event === Event::LAST_PAID_DAY;
    }

    /**
     * Check if this is a connection test.
     *
     * @return bool True if event is CONNECTION_TEST
     */
    public function isConnectionTest(): bool
    {
        return $this->event === Event::CONNECTION_TEST;
    }

    /**
     * Check if this is an affiliation event.
     *
     * @return bool True if event is ON_AFFILIATION
     */
    public function isAffiliation(): bool
    {
        return $this->event === Event::ON_AFFILIATION;
    }

    /**
     * Check if this is an e-ticket event.
     *
     * @return bool True if event is ETICKET
     */
    public function isEticket(): bool
    {
        return $this->event === Event::ETICKET;
    }

    /**
     * Check if this is a custom form event.
     *
     * @return bool True if event is CUSTOM_FORM
     */
    public function isCustomForm(): bool
    {
        return $this->event === Event::CUSTOM_FORM;
    }

    // ========================================
    // Validation
    // ========================================

    /**
     * Validate notification data for business logic errors.
     *
     * This method checks for common data integrity issues that could indicate
     * problems with the IPN data, even if the signature is valid.
     *
     * Validation checks:
     * - Email format validation
     * - Positive monetary amounts
     * - Positive order ID
     * - Required event field
     *
     * @return array<string> Array of error messages (empty array if valid)
     *
     * @example
     * ```php
     * $notification = Notification::fromPost();
     * $errors = $notification->validate();
     *
     * if (!empty($errors)) {
     *     foreach ($errors as $error) {
     *         error_log("Validation error: $error");
     *     }
     *     http_response_code(400);
     *     exit('Invalid data');
     * }
     * ```
     */
    public function validate(): array
    {
        $errors = [];

        // Validate email format if present
        if ($this->email !== null && !filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            $errors[] = "Invalid email format: {$this->email}";
        }

        // Validate monetary amounts are not negative
        $amountFields = [
            'amount_brutto',
            'amount_netto',
            'amount_affiliate',
            'amount_credited',
            'amount_fee',
            'amount_partner',
            'amount_payout',
            'amount_provider',
            'transaction_amount',
        ];

        foreach ($amountFields as $field) {
            if ($this->$field !== null && $this->$field < 0) {
                $errors[] = "{$field} must not be negative: {$this->$field}";
            }
        }

        // Validate order_id is positive if present
        if ($this->order_id !== null && $this->order_id <= 0) {
            $errors[] = "order_id must be positive: {$this->order_id}";
        }

        // Validate product_id is positive if present
        if ($this->product_id !== null && $this->product_id <= 0) {
            $errors[] = "product_id must be positive: {$this->product_id}";
        }

        // Validate event is set (required field)
        if ($this->event === null) {
            $errors[] = 'event field is required';
        }

        return $errors;
    }

    // ========================================
    // Serialization
    // ========================================

    /**
     * Convert notification to array.
     *
     * Returns all properties as an associative array, converting objects
     * to their string representations (Enums → value, DateTime → string).
     *
     * @return array<string, mixed> Notification data as array
     *
     * @example
     * ```php
     * $notification = Notification::fromPost();
     * $array = $notification->toArray();
     *
     * // Store in cache/queue
     * file_put_contents('cache.json', json_encode($array));
     * ```
     */
    public function toArray(): array
    {
        $data = [];

        foreach (get_object_vars($this) as $property => $value) {
            // Convert enums to their scalar values
            if ($value instanceof \BackedEnum) {
                $data[$property] = $value->value;
            }
            // Convert DateTimeImmutable to ISO 8601 string
            elseif ($value instanceof \DateTimeImmutable) {
                $data[$property] = $value->format('c');
            }
            // Keep everything else as-is
            else {
                $data[$property] = $value;
            }
        }

        return $data;
    }

    /**
     * Convert notification to JSON string.
     *
     * @return string JSON representation of the notification
     *
     * @throws \JsonException If JSON encoding fails
     *
     * @example
     * ```php
     * $notification = Notification::fromPost();
     * $json = $notification->toJson();
     *
     * // Send to queue system
     * $redis->rpush('ipn_queue', $json);
     * ```
     */
    public function toJson(): string
    {
        return json_encode($this->toArray(), JSON_THROW_ON_ERROR | JSON_PRETTY_PRINT);
    }

    /**
     * Create notification from JSON string.
     *
     * @param string $json JSON string representing notification data
     *
     * @return self New Notification instance
     *
     * @throws \JsonException If JSON decoding fails
     *
     * @example
     * ```php
     * // Retrieve from queue
     * $json = $redis->lpop('ipn_queue');
     * $notification = Notification::fromJson($json);
     *
     * // Process notification
     * if ($notification->isPayment()) {
     *     // Grant access
     * }
     * ```
     */
    public static function fromJson(string $json): self
    {
        $data = json_decode($json, true, 512, JSON_THROW_ON_ERROR);

        return self::fromArray($data);
    }
}
