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
use GoSuccess\Digistore24\Ipn\Util\NotificationSerializer;
use GoSuccess\Digistore24\Ipn\Util\NotificationValidator;
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
        set(mixed $value) => TypeConverter::toFloat($value);
    }

    public ?float $amount_brutto = null {
        set(mixed $value) => TypeConverter::toFloat($value);
    }

    public ?float $amount_credited = null {
        set(mixed $value) => TypeConverter::toFloat($value);
    }

    public ?float $amount_fee = null {
        set(mixed $value) => TypeConverter::toFloat($value);
    }

    public ?float $amount_netto = null {
        set(mixed $value) => TypeConverter::toFloat($value);
    }

    public ?float $amount_partner = null {
        set(mixed $value) => TypeConverter::toFloat($value);
    }

    public ?float $amount_payout = null {
        set(mixed $value) => TypeConverter::toFloat($value);
    }

    public ?float $amount_provider = null {
        set(mixed $value) => TypeConverter::toFloat($value);
    }

    public ?float $amount_vendor = null {
        set(mixed $value) => TypeConverter::toFloat($value);
    }

    public ?float $amount_vat = null {
        set(mixed $value) => TypeConverter::toFloat($value);
    }

    public ?string $address_city = null;

    public ?string $address_company = null;

    public ?string $address_country = null;

    public ?string $address_country_name = null;

    public ?string $address_email = null;

    public ?string $address_first_name = null;

    public ?string $address_id = null;

    public ?string $address_last_name = null;

    public ?string $address_phone_no = null;

    public ?Salutation $address_salutation = null {
        set(mixed $value) => TypeConverter::toEnum(Salutation::class, $value);
    }

    public ?string $address_state = null;

    public ?string $address_street = null;

    public ?string $address_street2 = null;

    public ?string $address_street_name = null;

    public ?string $address_street_number = null;

    public ?string $address_tax_id = null;

    public ?string $address_title = null;

    public ?string $address_zipcode = null;

    public ?string $affiliate_name = null;

    public ?int $affiliate_id = null {
        set(mixed $value) => TypeConverter::toInt($value);
    }

    public ?string $affiliate_link = null;

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
        set(mixed $value) => TypeConverter::toInt($value);
    }

    public ?string $campaignkey = null;

    public ?string $country = null;

    public ?string $coupon_code = null;

    public ?float $coupon_amount_left = null {
        set(mixed $value) => TypeConverter::toFloat($value);
    }

    public ?float $coupon_amount_total = null {
        set(mixed $value) => TypeConverter::toFloat($value);
    }

    public ?string $coupon_currency = null;

    public ?int $coupon_id = null {
        set(mixed $value) => TypeConverter::toInt($value);
    }

    public ?string $currency = null;

    public ?string $custom = null;

    public ?string $custom_key = null;

    public ?string $customer_affiliate_url = null;

    public ?string $customer_affiliate_name = null;

    public ?string $customer_affiliate_promo_url = null;

    public ?string $customer_to_affiliate_url = null;

    public ?DateTimeImmutable $delivery_date = null {
        set(mixed $value) => TypeConverter::toDateTime($value);
    }

    public ?string $email = null;

    public ?DateTimeImmutable $eticket_created_at = null {
        set(mixed $value) => TypeConverter::toDateTime($value);
    }

    public ?int $eticket_count = null {
        set(mixed $value) => TypeConverter::toInt($value);
    }

    public ?int $eticket_code = null {
        set(mixed $value) => TypeConverter::toInt($value);
    }

    public ?string $eticket_date = null;

    public ?string $eticket_hint = null;

    public ?int $eticket_id = null {
        set(mixed $value) => TypeConverter::toInt($value);
    }

    public ?bool $eticket_is_blocked = null {
        set(mixed $value) => TypeConverter::toBool($value);
    }

    public ?DateTimeImmutable $eticket_modified_at = null {
        set(mixed $value) => TypeConverter::toDateTime($value);
    }

    public ?int $eticket_no = null {
        set(mixed $value) => TypeConverter::toInt($value);
    }

    public ?string $eticket_url = null;

    public ?string $eticket_used_at = null;

    public ?Event $event = null {
        set(mixed $value) => match (true) {
            $value === null => null,
            $value instanceof Event => $value,
            is_string($value) => Event::from($value),
            default => throw new \InvalidArgumentException('Event value must be string or Event instance'),
        };
    }

    public ?string $event_label = null;

    public ?float $first_amount = null {
        set(mixed $value) => TypeConverter::toFloat($value);
    }

    public ?string $first_billing_interval = null;

    public ?float $first_vat_amount = null {
        set(mixed $value) => TypeConverter::toFloat($value);
    }

    public ?string $form_count = null;

    public ?string $form_no = null;

    public ?string $ipn_config_api_key_id = null;

    public ?int $ipn_config_domain_id = null {
        set(mixed $value) => TypeConverter::toInt($value);
    }

    public ?int $ipn_config_id = null {
        set(mixed $value) => TypeConverter::toInt($value);
    }

    public ?string $ipn_config_products_ids = null;

    public ?float $ipn_version = null {
        set(mixed $value) => TypeConverter::toFloat($value);
    }

    public ?DateTimeImmutable $is_cancelled_for = null {
        set(mixed $value) => TypeConverter::toDateTime($value);
    }

    public ?bool $is_gdpr_country = null {
        set(mixed $value) => TypeConverter::toBool($value);
    }

    public ?string $language = null;

    public ?string $license_created = null;

    public ?string $license_data_email = null;

    public ?string $license_data_first_name = null;

    public ?string $license_data_last_name = null;

    public ?string $license_data_product = null;

    public ?string $license_key = null;

    public ?string $license_key_type = null;

    public ?int $license_id = null {
        set(mixed $value) => TypeConverter::toInt($value);
    }

    public ?string $location_address = null;

    public ?string $location_country = null;

    public ?string $location_directions = null;

    public ?int $location_id = null {
        set(mixed $value) => TypeConverter::toInt($value);
    }

    public ?string $location_latitude = null;

    public ?string $location_longitude = null;

    public ?string $location_map_image_url = null;

    public ?string $location_name = null;

    public ?string $location_note = null;

    public ?string $merchant_name = null;

    public ?int $merchant_id = null {
        set(mixed $value) => TypeConverter::toInt($value);
    }

    public ?DateTimeImmutable $next_payment_at = null {
        set(mixed $value) => TypeConverter::toDateTime($value);
    }

    public ?string $newsletter_choice = null;

    public ?string $newsletter_choice_msg = null;

    public ?string $note = null;

    public ?int $number_of_installments = null {
        set(mixed $value) => TypeConverter::toInt($value);
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

    public ?string $order_details_url = null;

    public ?string $order_id = null;

    public ?bool $order_is_paid = null {
        set(mixed $value) => TypeConverter::toBool($value);
    }

    public ?string $order_time = null;

    public ?OrderType $order_type = null {
        set(mixed $value) => TypeConverter::toEnum(OrderType::class, $value);
    }

    public ?int $orderform_id = null {
        set(mixed $value) => TypeConverter::toInt($value);
    }

    public ?float $other_amounts = null {
        set(mixed $value) => TypeConverter::toFloat($value);
    }

    public ?string $other_billing_intervals = null;

    public ?float $other_vat_amounts = null {
        set(mixed $value) => TypeConverter::toFloat($value);
    }

    public ?PayMethod $pay_method = null {
        set(mixed $value) => TypeConverter::toEnum(PayMethod::class, $value);
    }

    public ?int $pay_sequence_no = null {
        set(mixed $value) => TypeConverter::toInt($value);
    }

    public ?int $payplan_id = null {
        set(mixed $value) => TypeConverter::toInt($value);
    }

    public ?string $payment_id = null;

    public ?ProductDeliveryType $product_delivery_type = null {
        set(mixed $value) => TypeConverter::toEnum(ProductDeliveryType::class, $value);
    }

    public ?float $product_amount = null {
        set(mixed $value) => TypeConverter::toFloat($value);
    }

    public ?int $product_id = null {
        set(mixed $value) => TypeConverter::toInt($value);
    }

    public ?string $product_ids = null;

    public ?string $product_language = null;

    public ?float $product_netto_amount = null {
        set(mixed $value) => TypeConverter::toFloat($value);
    }

    public ?string $product_name = null;

    public ?float $product_shipping_amount = null {
        set(mixed $value) => TypeConverter::toFloat($value);
    }

    public ?float $product_txn_amount = null {
        set(mixed $value) => TypeConverter::toFloat($value);
    }

    public ?float $product_txn_netto_amount = null {
        set(mixed $value) => TypeConverter::toFloat($value);
    }

    public ?float $product_txn_shipping = null {
        set(mixed $value) => TypeConverter::toFloat($value);
    }

    public ?float $product_txn_vat_amount = null {
        set(mixed $value) => TypeConverter::toFloat($value);
    }

    public ?float $product_vat_amount = null {
        set(mixed $value) => TypeConverter::toFloat($value);
    }

    public ?int $quantity = null {
        set(mixed $value) => TypeConverter::toInt($value);
    }

    public ?DateTimeImmutable $rebill_stop_noted_at = null {
        set(mixed $value) => TypeConverter::toDateTime($value);
    }

    public ?string $rebilling_stop_url = null;

    public ?string $receipt_url = null;

    public ?string $referring_affiliate_name = null;

    public ?string $refund_days = null;

    public ?string $renew_url = null;

    public ?string $request_refund_url = null;

    public ?string $salesteam_name = null;

    public ?int $salesteam_id = null {
        set(mixed $value) => TypeConverter::toInt($value);
    }

    public ?string $sha_sign = null;

    public ?string $SHASIGN = null;

    public ?string $support_url = null;

    /**
     * Tags as array (converted from comma-separated string).
     * Index starts at 0 (standard PHP array).
     * Example: $dto->tags[0] for first tag, $dto->tags[1] for second tag, etc.
     */
    public ?array $tags = null {
        set(mixed $value) {
            $this->tags = TypeConverter::toArray($value) ?: null;
        }
    }

    public ?float $transaction_amount = null {
        set(mixed $value) => TypeConverter::toFloat($value);
    }

    public ?string $transaction_currency = null;

    public ?int $transaction_id = null {
        set(mixed $value) => TypeConverter::toInt($value);
    }

    public ?DateTimeImmutable $transaction_date = null {
        set(mixed $value) => TypeConverter::toDateTime($value);
    }

    public ?DateTimeImmutable $transaction_processed_at = null {
        set(mixed $value) => TypeConverter::toDateTime($value);
    }

    public ?TransactionType $transaction_type = null {
        set(mixed $value) => TypeConverter::toEnum(TransactionType::class, $value);
    }

    public ?string $trackingkey = null;

    public ?string $upgrade_key = null;

    public ?UpgradeType $upgrade_type = null {
        set(mixed $value) => TypeConverter::toEnum(UpgradeType::class, $value);
    }

    public ?string $upgraded_address_first_name = null;

    public ?string $upgraded_address_last_name = null;

    public ?int $upgraded_buyer_id = null {
        set(mixed $value) => TypeConverter::toInt($value);
    }

    public ?string $upgraded_email = null;

    public ?string $upgraded_order_date = null;

    public ?string $upgraded_order_date_time = null;

    public ?string $upgraded_order_id = null;

    public ?string $upgraded_order_paid_until = null;

    public ?string $upgraded_order_time = null;

    public ?int $upgraded_product_id = null {
        set(mixed $value) => TypeConverter::toInt($value);
    }

    public ?string $upgraded_product_name = null;

    public ?string $variant_id = null;

    public ?string $variant_name = null;

    public ?float $vat_rate = null {
        set(mixed $value) => TypeConverter::toFloat($value);
    }

    public ?string $voucher_code = null;

    public ?string $used_coupon_code = null;

    public ?int $used_coupon_id = null {
        set(mixed $value) => TypeConverter::toInt($value);
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
     * Delegates to NotificationValidator utility class for validation logic.
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
     *
     * @see NotificationValidator::validate()
     */
    public function validate(): array
    {
        return NotificationValidator::validate($this);
    }

    // ========================================
    // Serialization
    // ========================================

    /**
     * Convert notification to array.
     *
     * Delegates to NotificationSerializer utility class for serialization.
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
     *
     * @see NotificationSerializer::toArray()
     */
    public function toArray(): array
    {
        return NotificationSerializer::toArray($this);
    }

    /**
     * Convert notification to JSON string.
     *
     * Delegates to NotificationSerializer utility class for JSON serialization.
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
     *
     * @see NotificationSerializer::toJson()
     */
    public function toJson(): string
    {
        return NotificationSerializer::toJson($this);
    }

    /**
     * Create notification from JSON string.
     *
     * Delegates to NotificationSerializer utility class for JSON deserialization.
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
     *
     * @see NotificationSerializer::fromJson()
     */
    public static function fromJson(string $json): self
    {
        return NotificationSerializer::fromJson($json);
    }
}
