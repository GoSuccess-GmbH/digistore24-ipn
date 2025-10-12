<?php

declare(strict_types=1);

namespace GoSuccess\Digistore24IPN;

use DateTimeImmutable;
use GoSuccess\Digistore24IPN\Enum\Action;
use GoSuccess\Digistore24IPN\Enum\BillingStatus;
use GoSuccess\Digistore24IPN\Enum\BillingStopReason;
use GoSuccess\Digistore24IPN\Enum\BillingType;
use GoSuccess\Digistore24IPN\Enum\Event;
use GoSuccess\Digistore24IPN\Enum\OrderType;
use GoSuccess\Digistore24IPN\Enum\PayMethod;
use GoSuccess\Digistore24IPN\Enum\ProductDeliveryType;
use GoSuccess\Digistore24IPN\Enum\TransactionType;
use GoSuccess\Digistore24IPN\Enum\UpgradeType;

/**
 * Data Transfer Object for handling IPN notifications from Digistore24.
 *
 * This class represents the notification data sent by Digistore24 to your webhook endpoint.
 * It uses PHP 8.4 Property Hooks for automatic type conversion.
 * All property names match the exact Digistore24 IPN field names (snake_case).
 * 
 * BREAKING CHANGE: No getter methods - use direct property access.
 * Example: $notification->order_id instead of $notification->getOrderId()
 */
final class Notification
{
    public ?Action $action = null {
        set(mixed $value) => $value !== null ? Action::from($value) : null;
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

    public ?string $address_salutation = null {
        set(mixed $value) => $value !== null ? $value : null;
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
        set(mixed $value) => $value !== null ? BillingStatus::from($value) : null;
    }

    public ?BillingStopReason $billing_stop_reason = null {
        set(mixed $value) => $value !== null ? BillingStopReason::from($value) : null;
    }

    public ?BillingType $billing_type = null {
        set(mixed $value) => $value !== null ? BillingType::from($value) : null;
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
        set(mixed $value) => $value !== null ? Event::from($value) : null;
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
        set(mixed $value) => $value !== null ? BillingStatus::from($value) : null;
    }

    public ?DateTimeImmutable $order_date = null {
        set(mixed $value) => $value !== null ? DateTimeImmutable::createFromFormat(DATE_ATOM, $value) ?: new DateTimeImmutable($value) : null;
    }

    public ?DateTimeImmutable $order_date_time = null {
        set(mixed $value) => $value !== null ? DateTimeImmutable::createFromFormat(DATE_ATOM, $value) ?: new DateTimeImmutable($value) : null;
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
        set(mixed $value) => $value !== null ? OrderType::from($value) : null;
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
        set(mixed $value) => $value !== null ? PayMethod::from($value) : null;
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
        set(mixed $value) => $value !== null ? ProductDeliveryType::from($value) : null;
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
     * 
     * @var string[]|null
     */
    public ?array $tags = null {
        set(mixed $value) => $value !== null && $value !== '' 
            ? array_filter(array_map('trim', explode(',', $value)), fn($tag) => $tag !== '')
            : null;
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
        set(mixed $value) => $value !== null ? TransactionType::from($value) : null;
    }

    public ?string $trackingkey = null {
        set(mixed $value) => $value !== null ? $value : null;
    }

    public ?string $upgrade_key = null {
        set(mixed $value) => $value !== null ? $value : null;
    }

    public ?UpgradeType $upgrade_type = null {
        set(mixed $value) => $value !== null ? UpgradeType::from($value) : null;
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
     * Parse boolean value from various formats.
     */
    private static function parseBool(mixed $value): ?bool
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

    /**
     * Create instance from associative array.
     * Property Hooks handle all type conversion automatically.
     */
    public static function fromArray(array $data): self
    {
        $dto = new self();
        foreach ($data as $key => $value) {
            if (property_exists($dto, $key)) {
                $dto->$key = $value;
            }
        }
        return $dto;
    }

    /**
     * Create instance from POST data.
     */
    public static function fromPost(): self
    {
        return self::fromArray($_POST);
    }

    /**
     * Create instance from GET data.
     */
    public static function fromGet(): self
    {
        return self::fromArray($_GET);
    }
}
