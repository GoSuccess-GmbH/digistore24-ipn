<?php

declare(strict_types=1);

namespace GoSuccess\Digistore24IPN\Dto;

use DateTimeImmutable;
use GoSuccess\Digistore24IPN\DHelper\DtoHelper;
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
 * Data Transfer Object for handling IPN requests from Digistore24.
 *
 * This class encapsulates the properties and methods required to process
 * incoming IPN notifications, including payment details, buyer information,
 * and event types.
 */
class IPNRequestDto
{
    public function __construct(
        private ?Action $action = null,
        private ?float $amount_affiliate = null,
        private ?float $amount_brutto = null,
        private ?float $amount_credited = null,
        private ?float $amount_fee = null,
        private ?float $amount_netto = null,
        private ?float $amount_partner = null,
        private ?float $amount_payout = null,
        private ?float $amount_provider = null,
        private ?float $amount_vendor = null,
        private ?float $amount_vat = null,
        private ?string $address_city = null,
        private ?string $address_company = null,
        private ?string $address_country = null,
        private ?string $address_country_name = null,
        private ?string $address_email = null,
        private ?string $address_first_name = null,
        private ?string $address_id = null,
        private ?string $address_last_name = null,
        private ?string $address_phone_no = null,
        private ?string $address_salutation = null,
        private ?string $address_state = null,
        private ?string $address_street = null,
        private ?string $address_street2 = null,
        private ?string $address_street_name = null,
        private ?string $address_street_number = null,
        private ?string $address_tax_id = null,
        private ?string $address_title = null,
        private ?string $address_zipcode = null,
        private ?string $affiliate_name = null,
        private ?int $affiliate_id = null,
        private ?string $affiliate_link = null,
        private ?BillingStatus $billing_status = null,
        private ?BillingStopReason $billing_stop_reason = null,
        private ?BillingType $billing_type = null,
        private ?int $buyer_id = null,
        private ?string $campaignkey = null,
        private ?string $country = null,
        private ?string $coupon_code = null,
        private ?string $coupon_code_2 = null,
        private ?string $coupon_code_3 = null,
        private ?string $coupon_code_4 = null,
        private ?string $coupon_code_5 = null,
        private ?string $coupon_code_6 = null,
        private ?string $coupon_code_7 = null,
        private ?string $coupon_code_8 = null,
        private ?string $coupon_code_9 = null,
        private ?string $coupon_code_10 = null,
        private ?string $coupon_code_11 = null,
        private ?string $coupon_code_12 = null,
        private ?string $coupon_code_13 = null,
        private ?string $coupon_code_14 = null,
        private ?string $coupon_code_15 = null,
        private ?string $coupon_code_16 = null,
        private ?string $coupon_code_17 = null,
        private ?string $coupon_code_18 = null,
        private ?string $coupon_code_19 = null,
        private ?string $coupon_code_20 = null,
        private ?string $coupon_code_21 = null,
        private ?string $coupon_code_22 = null,
        private ?string $coupon_code_23 = null,
        private ?string $coupon_code_24 = null,
        private ?string $coupon_code_25 = null,
        private ?string $coupon_code_26 = null,
        private ?string $coupon_code_27 = null,
        private ?string $coupon_code_28 = null,
        private ?string $coupon_code_29 = null,
        private ?string $coupon_code_30 = null,
        private ?string $coupon_code_31 = null,
        private ?string $coupon_code_32 = null,
        private ?string $coupon_code_33 = null,
        private ?string $coupon_code_34 = null,
        private ?string $coupon_code_35 = null,
        private ?string $coupon_code_36 = null,
        private ?string $coupon_code_37 = null,
        private ?string $coupon_code_38 = null,
        private ?string $coupon_code_39 = null,
        private ?string $coupon_code_40 = null,
        private ?string $coupon_code_41 = null,
        private ?string $coupon_code_42 = null,
        private ?string $coupon_code_43 = null,
        private ?string $coupon_code_44 = null,
        private ?string $coupon_code_45 = null,
        private ?string $coupon_code_46 = null,
        private ?string $coupon_code_47 = null,
        private ?string $coupon_code_48 = null,
        private ?string $coupon_code_49 = null,
        private ?string $coupon_code_50 = null,
        private ?string $coupon_code_51 = null,
        private ?string $coupon_code_52 = null,
        private ?string $coupon_code_53 = null,
        private ?string $coupon_code_54 = null,
        private ?string $coupon_code_55 = null,
        private ?string $coupon_code_56 = null,
        private ?string $coupon_code_57 = null,
        private ?string $coupon_code_58 = null,
        private ?string $coupon_code_59 = null,
        private ?string $coupon_code_60 = null,
        private ?string $coupon_code_61 = null,
        private ?string $coupon_code_62 = null,
        private ?string $coupon_code_63 = null,
        private ?string $coupon_code_64 = null,
        private ?string $coupon_code_65 = null,
        private ?string $coupon_code_66 = null,
        private ?string $coupon_code_67 = null,
        private ?string $coupon_code_68 = null,
        private ?string $coupon_code_69 = null,
        private ?string $coupon_code_70 = null,
        private ?string $coupon_code_71 = null,
        private ?string $coupon_code_72 = null,
        private ?string $coupon_code_73 = null,
        private ?string $coupon_code_74 = null,
        private ?string $coupon_code_75 = null,
        private ?string $coupon_code_76 = null,
        private ?string $coupon_code_77 = null,
        private ?string $coupon_code_78 = null,
        private ?string $coupon_code_79 = null,
        private ?string $coupon_code_80 = null,
        private ?string $coupon_code_81 = null,
        private ?string $coupon_code_82 = null,
        private ?string $coupon_code_83 = null,
        private ?string $coupon_code_84 = null,
        private ?string $coupon_code_85 = null,
        private ?string $coupon_code_86 = null,
        private ?string $coupon_code_87 = null,
        private ?string $coupon_code_88 = null,
        private ?string $coupon_code_89 = null,
        private ?string $coupon_code_90 = null,
        private ?string $coupon_code_91 = null,
        private ?string $coupon_code_92 = null,
        private ?string $coupon_code_93 = null,
        private ?string $coupon_code_94 = null,
        private ?string $coupon_code_95 = null,
        private ?string $coupon_code_96 = null,
        private ?string $coupon_code_97 = null,
        private ?string $coupon_code_98 = null,
        private ?string $coupon_code_99 = null,
        private ?string $coupon_code_100 = null,
        private ?float $coupon_amount_left = null,
        private ?float $coupon_amount_left_2 = null,
        private ?float $coupon_amount_left_3 = null,
        private ?float $coupon_amount_left_4 = null,
        private ?float $coupon_amount_left_5 = null,
        private ?float $coupon_amount_left_6 = null,
        private ?float $coupon_amount_left_7 = null,
        private ?float $coupon_amount_left_8 = null,
        private ?float $coupon_amount_left_9 = null,
        private ?float $coupon_amount_left_10 = null,
        private ?float $coupon_amount_left_11 = null,
        private ?float $coupon_amount_left_12 = null,
        private ?float $coupon_amount_left_13 = null,
        private ?float $coupon_amount_left_14 = null,
        private ?float $coupon_amount_left_15 = null,
        private ?float $coupon_amount_left_16 = null,
        private ?float $coupon_amount_left_17 = null,
        private ?float $coupon_amount_left_18 = null,
        private ?float $coupon_amount_left_19 = null,
        private ?float $coupon_amount_left_20 = null,
        private ?float $coupon_amount_left_21 = null,
        private ?float $coupon_amount_left_22 = null,
        private ?float $coupon_amount_left_23 = null,
        private ?float $coupon_amount_left_24 = null,
        private ?float $coupon_amount_left_25 = null,
        private ?float $coupon_amount_left_26 = null,
        private ?float $coupon_amount_left_27 = null,
        private ?float $coupon_amount_left_28 = null,
        private ?float $coupon_amount_left_29 = null,
        private ?float $coupon_amount_left_30 = null,
        private ?float $coupon_amount_left_31 = null,
        private ?float $coupon_amount_left_32 = null,
        private ?float $coupon_amount_left_33 = null,
        private ?float $coupon_amount_left_34 = null,
        private ?float $coupon_amount_left_35 = null,
        private ?float $coupon_amount_left_36 = null,
        private ?float $coupon_amount_left_37 = null,
        private ?float $coupon_amount_left_38 = null,
        private ?float $coupon_amount_left_39 = null,
        private ?float $coupon_amount_left_40 = null,
        private ?float $coupon_amount_left_41 = null,
        private ?float $coupon_amount_left_42 = null,
        private ?float $coupon_amount_left_43 = null,
        private ?float $coupon_amount_left_44 = null,
        private ?float $coupon_amount_left_45 = null,
        private ?float $coupon_amount_left_46 = null,
        private ?float $coupon_amount_left_47 = null,
        private ?float $coupon_amount_left_48 = null,
        private ?float $coupon_amount_left_49 = null,
        private ?float $coupon_amount_left_50 = null,
        private ?float $coupon_amount_left_51 = null,
        private ?float $coupon_amount_left_52 = null,
        private ?float $coupon_amount_left_53 = null,
        private ?float $coupon_amount_left_54 = null,
        private ?float $coupon_amount_left_55 = null,
        private ?float $coupon_amount_left_56 = null,
        private ?float $coupon_amount_left_57 = null,
        private ?float $coupon_amount_left_58 = null,
        private ?float $coupon_amount_left_59 = null,
        private ?float $coupon_amount_left_60 = null,
        private ?float $coupon_amount_left_61 = null,
        private ?float $coupon_amount_left_62 = null,
        private ?float $coupon_amount_left_63 = null,
        private ?float $coupon_amount_left_64 = null,
        private ?float $coupon_amount_left_65 = null,
        private ?float $coupon_amount_left_66 = null,
        private ?float $coupon_amount_left_67 = null,
        private ?float $coupon_amount_left_68 = null,
        private ?float $coupon_amount_left_69 = null,
        private ?float $coupon_amount_left_70 = null,
        private ?float $coupon_amount_left_71 = null,
        private ?float $coupon_amount_left_72 = null,
        private ?float $coupon_amount_left_73 = null,
        private ?float $coupon_amount_left_74 = null,
        private ?float $coupon_amount_left_75 = null,
        private ?float $coupon_amount_left_76 = null,
        private ?float $coupon_amount_left_77 = null,
        private ?float $coupon_amount_left_78 = null,
        private ?float $coupon_amount_left_79 = null,
        private ?float $coupon_amount_left_80 = null,
        private ?float $coupon_amount_left_81 = null,
        private ?float $coupon_amount_left_82 = null,
        private ?float $coupon_amount_left_83 = null,
        private ?float $coupon_amount_left_84 = null,
        private ?float $coupon_amount_left_85 = null,
        private ?float $coupon_amount_left_86 = null,
        private ?float $coupon_amount_left_87 = null,
        private ?float $coupon_amount_left_88 = null,
        private ?float $coupon_amount_left_89 = null,
        private ?float $coupon_amount_left_90 = null,
        private ?float $coupon_amount_left_91 = null,
        private ?float $coupon_amount_left_92 = null,
        private ?float $coupon_amount_left_93 = null,
        private ?float $coupon_amount_left_94 = null,
        private ?float $coupon_amount_left_95 = null,
        private ?float $coupon_amount_left_96 = null,
        private ?float $coupon_amount_left_97 = null,
        private ?float $coupon_amount_left_98 = null,
        private ?float $coupon_amount_left_99 = null,
        private ?float $coupon_amount_left_100 = null,
        private ?float $coupon_amount_total = null,
        private ?float $coupon_amount_total_2 = null,
        private ?float $coupon_amount_total_3 = null,
        private ?float $coupon_amount_total_4 = null,
        private ?float $coupon_amount_total_5 = null,
        private ?float $coupon_amount_total_6 = null,
        private ?float $coupon_amount_total_7 = null,
        private ?float $coupon_amount_total_8 = null,
        private ?float $coupon_amount_total_9 = null,
        private ?float $coupon_amount_total_10 = null,
        private ?float $coupon_amount_total_11 = null,
        private ?float $coupon_amount_total_12 = null,
        private ?float $coupon_amount_total_13 = null,
        private ?float $coupon_amount_total_14 = null,
        private ?float $coupon_amount_total_15 = null,
        private ?float $coupon_amount_total_16 = null,
        private ?float $coupon_amount_total_17 = null,
        private ?float $coupon_amount_total_18 = null,
        private ?float $coupon_amount_total_19 = null,
        private ?float $coupon_amount_total_20 = null,
        private ?float $coupon_amount_total_21 = null,
        private ?float $coupon_amount_total_22 = null,
        private ?float $coupon_amount_total_23 = null,
        private ?float $coupon_amount_total_24 = null,
        private ?float $coupon_amount_total_25 = null,
        private ?float $coupon_amount_total_26 = null,
        private ?float $coupon_amount_total_27 = null,
        private ?float $coupon_amount_total_28 = null,
        private ?float $coupon_amount_total_29 = null,
        private ?float $coupon_amount_total_30 = null,
        private ?float $coupon_amount_total_31 = null,
        private ?float $coupon_amount_total_32 = null,
        private ?float $coupon_amount_total_33 = null,
        private ?float $coupon_amount_total_34 = null,
        private ?float $coupon_amount_total_35 = null,
        private ?float $coupon_amount_total_36 = null,
        private ?float $coupon_amount_total_37 = null,
        private ?float $coupon_amount_total_38 = null,
        private ?float $coupon_amount_total_39 = null,
        private ?float $coupon_amount_total_40 = null,
        private ?float $coupon_amount_total_41 = null,
        private ?float $coupon_amount_total_42 = null,
        private ?float $coupon_amount_total_43 = null,
        private ?float $coupon_amount_total_44 = null,
        private ?float $coupon_amount_total_45 = null,
        private ?float $coupon_amount_total_46 = null,
        private ?float $coupon_amount_total_47 = null,
        private ?float $coupon_amount_total_48 = null,
        private ?float $coupon_amount_total_49 = null,
        private ?float $coupon_amount_total_50 = null,
        private ?float $coupon_amount_total_51 = null,
        private ?float $coupon_amount_total_52 = null,
        private ?float $coupon_amount_total_53 = null,
        private ?float $coupon_amount_total_54 = null,
        private ?float $coupon_amount_total_55 = null,
        private ?float $coupon_amount_total_56 = null,
        private ?float $coupon_amount_total_57 = null,
        private ?float $coupon_amount_total_58 = null,
        private ?float $coupon_amount_total_59 = null,
        private ?float $coupon_amount_total_60 = null,
        private ?float $coupon_amount_total_61 = null,
        private ?float $coupon_amount_total_62 = null,
        private ?float $coupon_amount_total_63 = null,
        private ?float $coupon_amount_total_64 = null,
        private ?float $coupon_amount_total_65 = null,
        private ?float $coupon_amount_total_66 = null,
        private ?float $coupon_amount_total_67 = null,
        private ?float $coupon_amount_total_68 = null,
        private ?float $coupon_amount_total_69 = null,
        private ?float $coupon_amount_total_70 = null,
        private ?float $coupon_amount_total_71 = null,
        private ?float $coupon_amount_total_72 = null,
        private ?float $coupon_amount_total_73 = null,
        private ?float $coupon_amount_total_74 = null,
        private ?float $coupon_amount_total_75 = null,
        private ?float $coupon_amount_total_76 = null,
        private ?float $coupon_amount_total_77 = null,
        private ?float $coupon_amount_total_78 = null,
        private ?float $coupon_amount_total_79 = null,
        private ?float $coupon_amount_total_80 = null,
        private ?float $coupon_amount_total_81 = null,
        private ?float $coupon_amount_total_82 = null,
        private ?float $coupon_amount_total_83 = null,
        private ?float $coupon_amount_total_84 = null,
        private ?float $coupon_amount_total_85 = null,
        private ?float $coupon_amount_total_86 = null,
        private ?float $coupon_amount_total_87 = null,
        private ?float $coupon_amount_total_88 = null,
        private ?float $coupon_amount_total_89 = null,
        private ?float $coupon_amount_total_90 = null,
        private ?float $coupon_amount_total_91 = null,
        private ?float $coupon_amount_total_92 = null,
        private ?float $coupon_amount_total_93 = null,
        private ?float $coupon_amount_total_94 = null,
        private ?float $coupon_amount_total_95 = null,
        private ?float $coupon_amount_total_96 = null,
        private ?float $coupon_amount_total_97 = null,
        private ?float $coupon_amount_total_98 = null,
        private ?float $coupon_amount_total_99 = null,
        private ?float $coupon_amount_total_100 = null,
        private ?string $coupon_currency = null,
        private ?string $coupon_currency_2 = null,
        private ?string $coupon_currency_3 = null,
        private ?string $coupon_currency_4 = null,
        private ?string $coupon_currency_5 = null,
        private ?string $coupon_currency_6 = null,
        private ?string $coupon_currency_7 = null,
        private ?string $coupon_currency_8 = null,
        private ?string $coupon_currency_9 = null,
        private ?string $coupon_currency_10 = null,
        private ?string $coupon_currency_11 = null,
        private ?string $coupon_currency_12 = null,
        private ?string $coupon_currency_13 = null,
        private ?string $coupon_currency_14 = null,
        private ?string $coupon_currency_15 = null,
        private ?string $coupon_currency_16 = null,
        private ?string $coupon_currency_17 = null,
        private ?string $coupon_currency_18 = null,
        private ?string $coupon_currency_19 = null,
        private ?string $coupon_currency_20 = null,
        private ?string $coupon_currency_21 = null,
        private ?string $coupon_currency_22 = null,
        private ?string $coupon_currency_23 = null,
        private ?string $coupon_currency_24 = null,
        private ?string $coupon_currency_25 = null,
        private ?string $coupon_currency_26 = null,
        private ?string $coupon_currency_27 = null,
        private ?string $coupon_currency_28 = null,
        private ?string $coupon_currency_29 = null,
        private ?string $coupon_currency_30 = null,
        private ?string $coupon_currency_31 = null,
        private ?string $coupon_currency_32 = null,
        private ?string $coupon_currency_33 = null,
        private ?string $coupon_currency_34 = null,
        private ?string $coupon_currency_35 = null,
        private ?string $coupon_currency_36 = null,
        private ?string $coupon_currency_37 = null,
        private ?string $coupon_currency_38 = null,
        private ?string $coupon_currency_39 = null,
        private ?string $coupon_currency_40 = null,
        private ?string $coupon_currency_41 = null,
        private ?string $coupon_currency_42 = null,
        private ?string $coupon_currency_43 = null,
        private ?string $coupon_currency_44 = null,
        private ?string $coupon_currency_45 = null,
        private ?string $coupon_currency_46 = null,
        private ?string $coupon_currency_47 = null,
        private ?string $coupon_currency_48 = null,
        private ?string $coupon_currency_49 = null,
        private ?string $coupon_currency_50 = null,
        private ?string $coupon_currency_51 = null,
        private ?string $coupon_currency_52 = null,
        private ?string $coupon_currency_53 = null,
        private ?string $coupon_currency_54 = null,
        private ?string $coupon_currency_55 = null,
        private ?string $coupon_currency_56 = null,
        private ?string $coupon_currency_57 = null,
        private ?string $coupon_currency_58 = null,
        private ?string $coupon_currency_59 = null,
        private ?string $coupon_currency_60 = null,
        private ?string $coupon_currency_61 = null,
        private ?string $coupon_currency_62 = null,
        private ?string $coupon_currency_63 = null,
        private ?string $coupon_currency_64 = null,
        private ?string $coupon_currency_65 = null,
        private ?string $coupon_currency_66 = null,
        private ?string $coupon_currency_67 = null,
        private ?string $coupon_currency_68 = null,
        private ?string $coupon_currency_69 = null,
        private ?string $coupon_currency_70 = null,
        private ?string $coupon_currency_71 = null,
        private ?string $coupon_currency_72 = null,
        private ?string $coupon_currency_73 = null,
        private ?string $coupon_currency_74 = null,
        private ?string $coupon_currency_75 = null,
        private ?string $coupon_currency_76 = null,
        private ?string $coupon_currency_77 = null,
        private ?string $coupon_currency_78 = null,
        private ?string $coupon_currency_79 = null,
        private ?string $coupon_currency_80 = null,
        private ?string $coupon_currency_81 = null,
        private ?string $coupon_currency_82 = null,
        private ?string $coupon_currency_83 = null,
        private ?string $coupon_currency_84 = null,
        private ?string $coupon_currency_85 = null,
        private ?string $coupon_currency_86 = null,
        private ?string $coupon_currency_87 = null,
        private ?string $coupon_currency_88 = null,
        private ?string $coupon_currency_89 = null,
        private ?string $coupon_currency_90 = null,
        private ?string $coupon_currency_91 = null,
        private ?string $coupon_currency_92 = null,
        private ?string $coupon_currency_93 = null,
        private ?string $coupon_currency_94 = null,
        private ?string $coupon_currency_95 = null,
        private ?string $coupon_currency_96 = null,
        private ?string $coupon_currency_97 = null,
        private ?string $coupon_currency_98 = null,
        private ?string $coupon_currency_99 = null,
        private ?string $coupon_currency_100 = null,
        private ?int $coupon_id = null,
        private ?string $currency = null,
        private ?string $custom = null,
        private ?string $custom_key = null,
        private ?string $customer_affiliate_url = null,
        private ?string $customer_affiliate_name = null,
        private ?string $customer_affiliate_promo_url = null,
        private ?string $customer_to_affiliate_url = null,
        private ?DateTimeImmutable $delivery_date = null,
        private ?string $email = null,
        private ?DateTimeImmutable $eticket_created_at = null,
        private ?int $eticket_count = null,
        private ?int $eticket_code = null,
        private ?string $eticket_date = null,
        private ?string $eticket_date_2 = null,
        private ?string $eticket_date_3 = null,
        private ?string $eticket_date_4 = null,
        private ?string $eticket_date_5 = null,
        private ?string $eticket_date_6 = null,
        private ?string $eticket_date_7 = null,
        private ?string $eticket_date_8 = null,
        private ?string $eticket_date_9 = null,
        private ?string $eticket_date_10 = null,
        private ?string $eticket_date_11 = null,
        private ?string $eticket_date_12 = null,
        private ?string $eticket_date_13 = null,
        private ?string $eticket_date_14 = null,
        private ?string $eticket_date_15 = null,
        private ?string $eticket_date_16 = null,
        private ?string $eticket_date_17 = null,
        private ?string $eticket_date_18 = null,
        private ?string $eticket_date_19 = null,
        private ?string $eticket_date_20 = null,
        private ?string $eticket_date_21 = null,
        private ?string $eticket_date_22 = null,
        private ?string $eticket_date_23 = null,
        private ?string $eticket_date_24 = null,
        private ?string $eticket_date_25 = null,
        private ?string $eticket_date_26 = null,
        private ?string $eticket_date_27 = null,
        private ?string $eticket_date_28 = null,
        private ?string $eticket_date_29 = null,
        private ?string $eticket_date_30 = null,
        private ?string $eticket_date_31 = null,
        private ?string $eticket_date_32 = null,
        private ?string $eticket_date_33 = null,
        private ?string $eticket_date_34 = null,
        private ?string $eticket_date_35 = null,
        private ?string $eticket_date_36 = null,
        private ?string $eticket_date_37 = null,
        private ?string $eticket_date_38 = null,
        private ?string $eticket_date_39 = null,
        private ?string $eticket_date_40 = null,
        private ?string $eticket_date_41 = null,
        private ?string $eticket_date_42 = null,
        private ?string $eticket_date_43 = null,
        private ?string $eticket_date_44 = null,
        private ?string $eticket_date_45 = null,
        private ?string $eticket_date_46 = null,
        private ?string $eticket_date_47 = null,
        private ?string $eticket_date_48 = null,
        private ?string $eticket_date_49 = null,
        private ?string $eticket_date_50 = null,
        private ?string $eticket_date_51 = null,
        private ?string $eticket_date_52 = null,
        private ?string $eticket_date_53 = null,
        private ?string $eticket_date_54 = null,
        private ?string $eticket_date_55 = null,
        private ?string $eticket_date_56 = null,
        private ?string $eticket_date_57 = null,
        private ?string $eticket_date_58 = null,
        private ?string $eticket_date_59 = null,
        private ?string $eticket_date_60 = null,
        private ?string $eticket_date_61 = null,
        private ?string $eticket_date_62 = null,
        private ?string $eticket_date_63 = null,
        private ?string $eticket_date_64 = null,
        private ?string $eticket_date_65 = null,
        private ?string $eticket_date_66 = null,
        private ?string $eticket_date_67 = null,
        private ?string $eticket_date_68 = null,
        private ?string $eticket_date_69 = null,
        private ?string $eticket_date_70 = null,
        private ?string $eticket_date_71 = null,
        private ?string $eticket_date_72 = null,
        private ?string $eticket_date_73 = null,
        private ?string $eticket_date_74 = null,
        private ?string $eticket_date_75 = null,
        private ?string $eticket_date_76 = null,
        private ?string $eticket_date_77 = null,
        private ?string $eticket_date_78 = null,
        private ?string $eticket_date_79 = null,
        private ?string $eticket_date_80 = null,
        private ?string $eticket_date_81 = null,
        private ?string $eticket_date_82 = null,
        private ?string $eticket_date_83 = null,
        private ?string $eticket_date_84 = null,
        private ?string $eticket_date_85 = null,
        private ?string $eticket_date_86 = null,
        private ?string $eticket_date_87 = null,
        private ?string $eticket_date_88 = null,
        private ?string $eticket_date_89 = null,
        private ?string $eticket_date_90 = null,
        private ?string $eticket_date_91 = null,
        private ?string $eticket_date_92 = null,
        private ?string $eticket_date_93 = null,
        private ?string $eticket_date_94 = null,
        private ?string $eticket_date_95 = null,
        private ?string $eticket_date_96 = null,
        private ?string $eticket_date_97 = null,
        private ?string $eticket_date_98 = null,
        private ?string $eticket_date_99 = null,
        private ?string $eticket_date_100 = null,
        private ?string $eticket_hint = null,
        private ?string $eticket_hint_2 = null,
        private ?string $eticket_hint_3 = null,
        private ?string $eticket_hint_4 = null,
        private ?string $eticket_hint_5 = null,
        private ?string $eticket_hint_6 = null,
        private ?string $eticket_hint_7 = null,
        private ?string $eticket_hint_8 = null,
        private ?string $eticket_hint_9 = null,
        private ?string $eticket_hint_10 = null,
        private ?string $eticket_hint_11 = null,
        private ?string $eticket_hint_12 = null,
        private ?string $eticket_hint_13 = null,
        private ?string $eticket_hint_14 = null,
        private ?string $eticket_hint_15 = null,
        private ?string $eticket_hint_16 = null,
        private ?string $eticket_hint_17 = null,
        private ?string $eticket_hint_18 = null,
        private ?string $eticket_hint_19 = null,
        private ?string $eticket_hint_20 = null,
        private ?string $eticket_hint_21 = null,
        private ?string $eticket_hint_22 = null,
        private ?string $eticket_hint_23 = null,
        private ?string $eticket_hint_24 = null,
        private ?string $eticket_hint_25 = null,
        private ?string $eticket_hint_26 = null,
        private ?string $eticket_hint_27 = null,
        private ?string $eticket_hint_28 = null,
        private ?string $eticket_hint_29 = null,
        private ?string $eticket_hint_30 = null,
        private ?string $eticket_hint_31 = null,
        private ?string $eticket_hint_32 = null,
        private ?string $eticket_hint_33 = null,
        private ?string $eticket_hint_34 = null,
        private ?string $eticket_hint_35 = null,
        private ?string $eticket_hint_36 = null,
        private ?string $eticket_hint_37 = null,
        private ?string $eticket_hint_38 = null,
        private ?string $eticket_hint_39 = null,
        private ?string $eticket_hint_40 = null,
        private ?string $eticket_hint_41 = null,
        private ?string $eticket_hint_42 = null,
        private ?string $eticket_hint_43 = null,
        private ?string $eticket_hint_44 = null,
        private ?string $eticket_hint_45 = null,
        private ?string $eticket_hint_46 = null,
        private ?string $eticket_hint_47 = null,
        private ?string $eticket_hint_48 = null,
        private ?string $eticket_hint_49 = null,
        private ?string $eticket_hint_50 = null,
        private ?string $eticket_hint_51 = null,
        private ?string $eticket_hint_52 = null,
        private ?string $eticket_hint_53 = null,
        private ?string $eticket_hint_54 = null,
        private ?string $eticket_hint_55 = null,
        private ?string $eticket_hint_56 = null,
        private ?string $eticket_hint_57 = null,
        private ?string $eticket_hint_58 = null,
        private ?string $eticket_hint_59 = null,
        private ?string $eticket_hint_60 = null,
        private ?string $eticket_hint_61 = null,
        private ?string $eticket_hint_62 = null,
        private ?string $eticket_hint_63 = null,
        private ?string $eticket_hint_64 = null,
        private ?string $eticket_hint_65 = null,
        private ?string $eticket_hint_66 = null,
        private ?string $eticket_hint_67 = null,
        private ?string $eticket_hint_68 = null,
        private ?string $eticket_hint_69 = null,
        private ?string $eticket_hint_70 = null,
        private ?string $eticket_hint_71 = null,
        private ?string $eticket_hint_72 = null,
        private ?string $eticket_hint_73 = null,
        private ?string $eticket_hint_74 = null,
        private ?string $eticket_hint_75 = null,
        private ?string $eticket_hint_76 = null,
        private ?string $eticket_hint_77 = null,
        private ?string $eticket_hint_78 = null,
        private ?string $eticket_hint_79 = null,
        private ?string $eticket_hint_80 = null,
        private ?string $eticket_hint_81 = null,
        private ?string $eticket_hint_82 = null,
        private ?string $eticket_hint_83 = null,
        private ?string $eticket_hint_84 = null,
        private ?string $eticket_hint_85 = null,
        private ?string $eticket_hint_86 = null,
        private ?string $eticket_hint_87 = null,
        private ?string $eticket_hint_88 = null,
        private ?string $eticket_hint_89 = null,
        private ?string $eticket_hint_90 = null,
        private ?string $eticket_hint_91 = null,
        private ?string $eticket_hint_92 = null,
        private ?string $eticket_hint_93 = null,
        private ?string $eticket_hint_94 = null,
        private ?string $eticket_hint_95 = null,
        private ?string $eticket_hint_96 = null,
        private ?string $eticket_hint_97 = null,
        private ?string $eticket_hint_98 = null,
        private ?string $eticket_hint_99 = null,
        private ?string $eticket_hint_100 = null,
        private ?int $eticket_id = null,
        private ?bool $eticket_is_blocked = null,
        private ?DateTimeImmutable $eticket_modified_at = null,
        private ?int $eticket_no = null,
        private ?string $eticket_url = null,
        private ?string $eticket_url_2 = null,
        private ?string $eticket_url_3 = null,
        private ?string $eticket_url_4 = null,
        private ?string $eticket_url_5 = null,
        private ?string $eticket_url_6 = null,
        private ?string $eticket_url_7 = null,
        private ?string $eticket_url_8 = null,
        private ?string $eticket_url_9 = null,
        private ?string $eticket_url_10 = null,
        private ?string $eticket_url_11 = null,
        private ?string $eticket_url_12 = null,
        private ?string $eticket_url_13 = null,
        private ?string $eticket_url_14 = null,
        private ?string $eticket_url_15 = null,
        private ?string $eticket_url_16 = null,
        private ?string $eticket_url_17 = null,
        private ?string $eticket_url_18 = null,
        private ?string $eticket_url_19 = null,
        private ?string $eticket_url_20 = null,
        private ?string $eticket_url_21 = null,
        private ?string $eticket_url_22 = null,
        private ?string $eticket_url_23 = null,
        private ?string $eticket_url_24 = null,
        private ?string $eticket_url_25 = null,
        private ?string $eticket_url_26 = null,
        private ?string $eticket_url_27 = null,
        private ?string $eticket_url_28 = null,
        private ?string $eticket_url_29 = null,
        private ?string $eticket_url_30 = null,
        private ?string $eticket_url_31 = null,
        private ?string $eticket_url_32 = null,
        private ?string $eticket_url_33 = null,
        private ?string $eticket_url_34 = null,
        private ?string $eticket_url_35 = null,
        private ?string $eticket_url_36 = null,
        private ?string $eticket_url_37 = null,
        private ?string $eticket_url_38 = null,
        private ?string $eticket_url_39 = null,
        private ?string $eticket_url_40 = null,
        private ?string $eticket_url_41 = null,
        private ?string $eticket_url_42 = null,
        private ?string $eticket_url_43 = null,
        private ?string $eticket_url_44 = null,
        private ?string $eticket_url_45 = null,
        private ?string $eticket_url_46 = null,
        private ?string $eticket_url_47 = null,
        private ?string $eticket_url_48 = null,
        private ?string $eticket_url_49 = null,
        private ?string $eticket_url_50 = null,
        private ?string $eticket_url_51 = null,
        private ?string $eticket_url_52 = null,
        private ?string $eticket_url_53 = null,
        private ?string $eticket_url_54 = null,
        private ?string $eticket_url_55 = null,
        private ?string $eticket_url_56 = null,
        private ?string $eticket_url_57 = null,
        private ?string $eticket_url_58 = null,
        private ?string $eticket_url_59 = null,
        private ?string $eticket_url_60 = null,
        private ?string $eticket_url_61 = null,
        private ?string $eticket_url_62 = null,
        private ?string $eticket_url_63 = null,
        private ?string $eticket_url_64 = null,
        private ?string $eticket_url_65 = null,
        private ?string $eticket_url_66 = null,
        private ?string $eticket_url_67 = null,
        private ?string $eticket_url_68 = null,
        private ?string $eticket_url_69 = null,
        private ?string $eticket_url_70 = null,
        private ?string $eticket_url_71 = null,
        private ?string $eticket_url_72 = null,
        private ?string $eticket_url_73 = null,
        private ?string $eticket_url_74 = null,
        private ?string $eticket_url_75 = null,
        private ?string $eticket_url_76 = null,
        private ?string $eticket_url_77 = null,
        private ?string $eticket_url_78 = null,
        private ?string $eticket_url_79 = null,
        private ?string $eticket_url_80 = null,
        private ?string $eticket_url_81 = null,
        private ?string $eticket_url_82 = null,
        private ?string $eticket_url_83 = null,
        private ?string $eticket_url_84 = null,
        private ?string $eticket_url_85 = null,
        private ?string $eticket_url_86 = null,
        private ?string $eticket_url_87 = null,
        private ?string $eticket_url_88 = null,
        private ?string $eticket_url_89 = null,
        private ?string $eticket_url_90 = null,
        private ?string $eticket_url_91 = null,
        private ?string $eticket_url_92 = null,
        private ?string $eticket_url_93 = null,
        private ?string $eticket_url_94 = null,
        private ?string $eticket_url_95 = null,
        private ?string $eticket_url_96 = null,
        private ?string $eticket_url_97 = null,
        private ?string $eticket_url_98 = null,
        private ?string $eticket_url_99 = null,
        private ?string $eticket_url_100 = null,
        private ?string $eticket_used_at = null,
        private ?Event $event = null,
        private ?string $event_label = null,
        private ?float $first_amount = null,
        private ?string $first_billing_interval = null,
        private ?float $first_vat_amount = null,
        private ?string $form_count = null,
        private ?string $form_no = null,
        private ?string $ipn_config_api_key_id = null,
        private ?int $ipn_config_domain_id = null,
        private ?int $ipn_config_id = null,
        private ?string $ipn_config_products_ids = null,
        private ?float $ipn_version = null,
        private ?DateTimeImmutable $is_cancelled_for = null,
        private ?bool $is_gdpr_country = null,
        private ?string $language = null,
        private ?string $license_created = null,
        private ?string $license_data_email = null,
        private ?string $license_data_first_name = null,
        private ?string $license_data_last_name = null,
        private ?string $license_data_product = null,
        private ?string $license_key = null,
        private ?string $license_key_2 = null,
        private ?string $license_key_3 = null,
        private ?string $license_key_4 = null,
        private ?string $license_key_5 = null,
        private ?string $license_key_6 = null,
        private ?string $license_key_7 = null,
        private ?string $license_key_8 = null,
        private ?string $license_key_9 = null,
        private ?string $license_key_10 = null,
        private ?string $license_key_11 = null,
        private ?string $license_key_12 = null,
        private ?string $license_key_13 = null,
        private ?string $license_key_14 = null,
        private ?string $license_key_15 = null,
        private ?string $license_key_16 = null,
        private ?string $license_key_17 = null,
        private ?string $license_key_18 = null,
        private ?string $license_key_19 = null,
        private ?string $license_key_20 = null,
        private ?string $license_key_21 = null,
        private ?string $license_key_22 = null,
        private ?string $license_key_23 = null,
        private ?string $license_key_24 = null,
        private ?string $license_key_25 = null,
        private ?string $license_key_26 = null,
        private ?string $license_key_27 = null,
        private ?string $license_key_28 = null,
        private ?string $license_key_29 = null,
        private ?string $license_key_30 = null,
        private ?string $license_key_31 = null,
        private ?string $license_key_32 = null,
        private ?string $license_key_33 = null,
        private ?string $license_key_34 = null,
        private ?string $license_key_35 = null,
        private ?string $license_key_36 = null,
        private ?string $license_key_37 = null,
        private ?string $license_key_38 = null,
        private ?string $license_key_39 = null,
        private ?string $license_key_40 = null,
        private ?string $license_key_41 = null,
        private ?string $license_key_42 = null,
        private ?string $license_key_43 = null,
        private ?string $license_key_44 = null,
        private ?string $license_key_45 = null,
        private ?string $license_key_46 = null,
        private ?string $license_key_47 = null,
        private ?string $license_key_48 = null,
        private ?string $license_key_49 = null,
        private ?string $license_key_50 = null,
        private ?string $license_key_51 = null,
        private ?string $license_key_52 = null,
        private ?string $license_key_53 = null,
        private ?string $license_key_54 = null,
        private ?string $license_key_55 = null,
        private ?string $license_key_56 = null,
        private ?string $license_key_57 = null,
        private ?string $license_key_58 = null,
        private ?string $license_key_59 = null,
        private ?string $license_key_60 = null,
        private ?string $license_key_61 = null,
        private ?string $license_key_62 = null,
        private ?string $license_key_63 = null,
        private ?string $license_key_64 = null,
        private ?string $license_key_65 = null,
        private ?string $license_key_66 = null,
        private ?string $license_key_67 = null,
        private ?string $license_key_68 = null,
        private ?string $license_key_69 = null,
        private ?string $license_key_70 = null,
        private ?string $license_key_71 = null,
        private ?string $license_key_72 = null,
        private ?string $license_key_73 = null,
        private ?string $license_key_74 = null,
        private ?string $license_key_75 = null,
        private ?string $license_key_76 = null,
        private ?string $license_key_77 = null,
        private ?string $license_key_78 = null,
        private ?string $license_key_79 = null,
        private ?string $license_key_80 = null,
        private ?string $license_key_81 = null,
        private ?string $license_key_82 = null,
        private ?string $license_key_83 = null,
        private ?string $license_key_84 = null,
        private ?string $license_key_85 = null,
        private ?string $license_key_86 = null,
        private ?string $license_key_87 = null,
        private ?string $license_key_88 = null,
        private ?string $license_key_89 = null,
        private ?string $license_key_90 = null,
        private ?string $license_key_91 = null,
        private ?string $license_key_92 = null,
        private ?string $license_key_93 = null,
        private ?string $license_key_94 = null,
        private ?string $license_key_95 = null,
        private ?string $license_key_96 = null,
        private ?string $license_key_97 = null,
        private ?string $license_key_98 = null,
        private ?string $license_key_99 = null,
        private ?string $license_key_100 = null,
        private ?string $license_key_type = null,
        private ?int $license_id = null,
        private ?string $location_address = null,
        private ?string $location_country = null,
        private ?string $location_directions = null,
        private ?int $location_id = null,
        private ?string $location_latitude = null,
        private ?string $location_longitude = null,
        private ?string $location_map_image_url = null,
        private ?string $location_name = null,
        private ?string $location_note = null,
        private ?string $merchant_name = null,
        private ?int $merchant_id = null,
        private ?DateTimeImmutable $next_payment_at = null,
        private ?string $newsletter_choice = null,
        private ?string $newsletter_choice_msg = null,
        private ?string $note = null,
        private ?int $number_of_installments = null,
        private ?BillingStatus $order_billing_status = null,
        private ?DateTimeImmutable $order_date = null,
        private ?DateTimeImmutable $order_date_time = null,
        private ?string $order_details_url = null,
        private ?string $order_id = null,
        private ?bool $order_is_paid = null,
        private ?string $order_time = null,
        private ?OrderType $order_type = null,
        private ?int $orderform_id = null,
        private ?float $other_amounts = null,
        private ?string $other_billing_intervals = null,
        private ?float $other_vat_amounts = null,
        private ?PayMethod $pay_method = null,
        private ?int $pay_sequence_no = null,
        private ?int $payplan_id = null,
        private ?string $payment_id = null,
        private ?ProductDeliveryType $product_delivery_type = null,
        private ?float $product_amount = null,
        private ?int $product_id = null,
        private ?int $product_id_2 = null,
        private ?int $product_id_3 = null,
        private ?int $product_id_4 = null,
        private ?int $product_id_5 = null,
        private ?int $product_id_6 = null,
        private ?int $product_id_7 = null,
        private ?int $product_id_8 = null,
        private ?int $product_id_9 = null,
        private ?int $product_id_10 = null,
        private ?int $product_id_11 = null,
        private ?int $product_id_12 = null,
        private ?int $product_id_13 = null,
        private ?int $product_id_14 = null,
        private ?int $product_id_15 = null,
        private ?int $product_id_16 = null,
        private ?int $product_id_17 = null,
        private ?int $product_id_18 = null,
        private ?int $product_id_19 = null,
        private ?int $product_id_20 = null,
        private ?int $product_id_21 = null,
        private ?int $product_id_22 = null,
        private ?int $product_id_23 = null,
        private ?int $product_id_24 = null,
        private ?int $product_id_25 = null,
        private ?int $product_id_26 = null,
        private ?int $product_id_27 = null,
        private ?int $product_id_28 = null,
        private ?int $product_id_29 = null,
        private ?int $product_id_30 = null,
        private ?int $product_id_31 = null,
        private ?int $product_id_32 = null,
        private ?int $product_id_33 = null,
        private ?int $product_id_34 = null,
        private ?int $product_id_35 = null,
        private ?int $product_id_36 = null,
        private ?int $product_id_37 = null,
        private ?int $product_id_38 = null,
        private ?int $product_id_39 = null,
        private ?int $product_id_40 = null,
        private ?int $product_id_41 = null,
        private ?int $product_id_42 = null,
        private ?int $product_id_43 = null,
        private ?int $product_id_44 = null,
        private ?int $product_id_45 = null,
        private ?int $product_id_46 = null,
        private ?int $product_id_47 = null,
        private ?int $product_id_48 = null,
        private ?int $product_id_49 = null,
        private ?int $product_id_50 = null,
        private ?int $product_id_51 = null,
        private ?int $product_id_52 = null,
        private ?int $product_id_53 = null,
        private ?int $product_id_54 = null,
        private ?int $product_id_55 = null,
        private ?int $product_id_56 = null,
        private ?int $product_id_57 = null,
        private ?int $product_id_58 = null,
        private ?int $product_id_59 = null,
        private ?int $product_id_60 = null,
        private ?int $product_id_61 = null,
        private ?int $product_id_62 = null,
        private ?int $product_id_63 = null,
        private ?int $product_id_64 = null,
        private ?int $product_id_65 = null,
        private ?int $product_id_66 = null,
        private ?int $product_id_67 = null,
        private ?int $product_id_68 = null,
        private ?int $product_id_69 = null,
        private ?int $product_id_70 = null,
        private ?int $product_id_71 = null,
        private ?int $product_id_72 = null,
        private ?int $product_id_73 = null,
        private ?int $product_id_74 = null,
        private ?int $product_id_75 = null,
        private ?int $product_id_76 = null,
        private ?int $product_id_77 = null,
        private ?int $product_id_78 = null,
        private ?int $product_id_79 = null,
        private ?int $product_id_80 = null,
        private ?int $product_id_81 = null,
        private ?int $product_id_82 = null,
        private ?int $product_id_83 = null,
        private ?int $product_id_84 = null,
        private ?int $product_id_85 = null,
        private ?int $product_id_86 = null,
        private ?int $product_id_87 = null,
        private ?int $product_id_88 = null,
        private ?int $product_id_89 = null,
        private ?int $product_id_90 = null,
        private ?int $product_id_91 = null,
        private ?int $product_id_92 = null,
        private ?int $product_id_93 = null,
        private ?int $product_id_94 = null,
        private ?int $product_id_95 = null,
        private ?int $product_id_96 = null,
        private ?int $product_id_97 = null,
        private ?int $product_id_98 = null,
        private ?int $product_id_99 = null,
        private ?int $product_id_100 = null,
        private ?string $product_ids = null,
        private ?string $product_language = null,
        private ?float $product_netto_amount = null,
        private ?string $product_name = null,
        private ?float $product_shipping_amount = null,
        private ?float $product_txn_amount = null,
        private ?float $product_txn_netto_amount = null,
        private ?float $product_txn_shipping = null,
        private ?float $product_txn_vat_amount = null,
        private ?float $product_vat_amount = null,
        private ?int $quantity = null,
        private ?DateTimeImmutable $rebill_stop_noted_at = null,
        private ?string $rebilling_stop_url = null,
        private ?string $receipt_url = null,
        private ?string $referring_affiliate_name = null,
        private ?string $refund_days = null,
        private ?string $renew_url = null,
        private ?string $request_refund_url = null,
        private ?string $salesteam_name = null,
        private ?int $salesteam_id = null,
        private ?string $sha_sign = null,
        private ?string $SHASIGN = null,
        private ?string $support_url = null,
        private ?string $tag1 = null,
        private ?string $tag2 = null,
        private ?string $tag3 = null,
        private ?string $tag4 = null,
        private ?string $tag5 = null,
        private ?string $tag6 = null,
        private ?string $tag7 = null,
        private ?string $tag8 = null,
        private ?string $tag9 = null,
        private ?string $tag10 = null,
        private ?string $tag11 = null,
        private ?string $tag12 = null,
        private ?string $tag13 = null,
        private ?string $tag14 = null,
        private ?string $tag15 = null,
        private ?string $tag16 = null,
        private ?string $tag17 = null,
        private ?string $tag18 = null,
        private ?string $tag19 = null,
        private ?string $tag20 = null,
        private ?string $tag21 = null,
        private ?string $tag22 = null,
        private ?string $tag23 = null,
        private ?string $tag24 = null,
        private ?string $tag25 = null,
        private ?string $tag26 = null,
        private ?string $tag27 = null,
        private ?string $tag28 = null,
        private ?string $tag29 = null,
        private ?string $tag30 = null,
        private ?string $tag31 = null,
        private ?string $tag32 = null,
        private ?string $tag33 = null,
        private ?string $tag34 = null,
        private ?string $tag35 = null,
        private ?string $tag36 = null,
        private ?string $tag37 = null,
        private ?string $tag38 = null,
        private ?string $tag39 = null,
        private ?string $tag40 = null,
        private ?string $tag41 = null,
        private ?string $tag42 = null,
        private ?string $tag43 = null,
        private ?string $tag44 = null,
        private ?string $tag45 = null,
        private ?string $tag46 = null,
        private ?string $tag47 = null,
        private ?string $tag48 = null,
        private ?string $tag49 = null,
        private ?string $tag50 = null,
        private ?string $tag51 = null,
        private ?string $tag52 = null,
        private ?string $tag53 = null,
        private ?string $tag54 = null,
        private ?string $tag55 = null,
        private ?string $tag56 = null,
        private ?string $tag57 = null,
        private ?string $tag58 = null,
        private ?string $tag59 = null,
        private ?string $tag60 = null,
        private ?string $tag61 = null,
        private ?string $tag62 = null,
        private ?string $tag63 = null,
        private ?string $tag64 = null,
        private ?string $tag65 = null,
        private ?string $tag66 = null,
        private ?string $tag67 = null,
        private ?string $tag68 = null,
        private ?string $tag69 = null,
        private ?string $tag70 = null,
        private ?string $tag71 = null,
        private ?string $tag72 = null,
        private ?string $tag73 = null,
        private ?string $tag74 = null,
        private ?string $tag75 = null,
        private ?string $tag76 = null,
        private ?string $tag77 = null,
        private ?string $tag78 = null,
        private ?string $tag79 = null,
        private ?string $tag80 = null,
        private ?string $tag81 = null,
        private ?string $tag82 = null,
        private ?string $tag83 = null,
        private ?string $tag84 = null,
        private ?string $tag85 = null,
        private ?string $tag86 = null,
        private ?string $tag87 = null,
        private ?string $tag88 = null,
        private ?string $tag89 = null,
        private ?string $tag90 = null,
        private ?string $tag91 = null,
        private ?string $tag92 = null,
        private ?string $tag93 = null,
        private ?string $tag94 = null,
        private ?string $tag95 = null,
        private ?string $tag96 = null,
        private ?string $tag97 = null,
        private ?string $tag98 = null,
        private ?string $tag99 = null,
        private ?string $tag100 = null,
        private ?string $tags = null,
        private ?float $transaction_amount = null,
        private ?string $transaction_currency = null,
        private ?int $transaction_id = null,
        private ?DateTimeImmutable $transaction_date = null,
        private ?DateTimeImmutable $transaction_processed_at = null,
        private ?TransactionType $transaction_type = null,
        private ?string $trackingkey = null,
        private ?string $upgrade_key = null,
        private ?UpgradeType $upgrade_type = null,
        private ?string $upgraded_address_first_name = null,
        private ?string $upgraded_address_last_name = null,
        private ?int $upgraded_buyer_id = null,
        private ?string $upgraded_email = null,
        private ?string $upgraded_order_date = null,
        private ?string $upgraded_order_date_time = null,
        private ?string $upgraded_order_id = null,
        private ?string $upgraded_order_paid_until = null,
        private ?string $upgraded_order_time = null,
        private ?int $upgraded_product_id = null,
        private ?int $upgraded_product_id_2 = null,
        private ?int $upgraded_product_id_3 = null,
        private ?int $upgraded_product_id_4 = null,
        private ?int $upgraded_product_id_5 = null,
        private ?int $upgraded_product_id_6 = null,
        private ?int $upgraded_product_id_7 = null,
        private ?int $upgraded_product_id_8 = null,
        private ?int $upgraded_product_id_9 = null,
        private ?int $upgraded_product_id_10 = null,
        private ?int $upgraded_product_id_11 = null,
        private ?int $upgraded_product_id_12 = null,
        private ?int $upgraded_product_id_13 = null,
        private ?int $upgraded_product_id_14 = null,
        private ?int $upgraded_product_id_15 = null,
        private ?int $upgraded_product_id_16 = null,
        private ?int $upgraded_product_id_17 = null,
        private ?int $upgraded_product_id_18 = null,
        private ?int $upgraded_product_id_19 = null,
        private ?int $upgraded_product_id_20 = null,
        private ?int $upgraded_product_id_21 = null,
        private ?int $upgraded_product_id_22 = null,
        private ?int $upgraded_product_id_23 = null,
        private ?int $upgraded_product_id_24 = null,
        private ?int $upgraded_product_id_25 = null,
        private ?int $upgraded_product_id_26 = null,
        private ?int $upgraded_product_id_27 = null,
        private ?int $upgraded_product_id_28 = null,
        private ?int $upgraded_product_id_29 = null,
        private ?int $upgraded_product_id_30 = null,
        private ?int $upgraded_product_id_31 = null,
        private ?int $upgraded_product_id_32 = null,
        private ?int $upgraded_product_id_33 = null,
        private ?int $upgraded_product_id_34 = null,
        private ?int $upgraded_product_id_35 = null,
        private ?int $upgraded_product_id_36 = null,
        private ?int $upgraded_product_id_37 = null,
        private ?int $upgraded_product_id_38 = null,
        private ?int $upgraded_product_id_39 = null,
        private ?int $upgraded_product_id_40 = null,
        private ?int $upgraded_product_id_41 = null,
        private ?int $upgraded_product_id_42 = null,
        private ?int $upgraded_product_id_43 = null,
        private ?int $upgraded_product_id_44 = null,
        private ?int $upgraded_product_id_45 = null,
        private ?int $upgraded_product_id_46 = null,
        private ?int $upgraded_product_id_47 = null,
        private ?int $upgraded_product_id_48 = null,
        private ?int $upgraded_product_id_49 = null,
        private ?int $upgraded_product_id_50 = null,
        private ?int $upgraded_product_id_51 = null,
        private ?int $upgraded_product_id_52 = null,
        private ?int $upgraded_product_id_53 = null,
        private ?int $upgraded_product_id_54 = null,
        private ?int $upgraded_product_id_55 = null,
        private ?int $upgraded_product_id_56 = null,
        private ?int $upgraded_product_id_57 = null,
        private ?int $upgraded_product_id_58 = null,
        private ?int $upgraded_product_id_59 = null,
        private ?int $upgraded_product_id_60 = null,
        private ?int $upgraded_product_id_61 = null,
        private ?int $upgraded_product_id_62 = null,
        private ?int $upgraded_product_id_63 = null,
        private ?int $upgraded_product_id_64 = null,
        private ?int $upgraded_product_id_65 = null,
        private ?int $upgraded_product_id_66 = null,
        private ?int $upgraded_product_id_67 = null,
        private ?int $upgraded_product_id_68 = null,
        private ?int $upgraded_product_id_69 = null,
        private ?int $upgraded_product_id_70 = null,
        private ?int $upgraded_product_id_71 = null,
        private ?int $upgraded_product_id_72 = null,
        private ?int $upgraded_product_id_73 = null,
        private ?int $upgraded_product_id_74 = null,
        private ?int $upgraded_product_id_75 = null,
        private ?int $upgraded_product_id_76 = null,
        private ?int $upgraded_product_id_77 = null,
        private ?int $upgraded_product_id_78 = null,
        private ?int $upgraded_product_id_79 = null,
        private ?int $upgraded_product_id_80 = null,
        private ?int $upgraded_product_id_81 = null,
        private ?int $upgraded_product_id_82 = null,
        private ?int $upgraded_product_id_83 = null,
        private ?int $upgraded_product_id_84 = null,
        private ?int $upgraded_product_id_85 = null,
        private ?int $upgraded_product_id_86 = null,
        private ?int $upgraded_product_id_87 = null,
        private ?int $upgraded_product_id_88 = null,
        private ?int $upgraded_product_id_89 = null,
        private ?int $upgraded_product_id_90 = null,
        private ?int $upgraded_product_id_91 = null,
        private ?int $upgraded_product_id_92 = null,
        private ?int $upgraded_product_id_93 = null,
        private ?int $upgraded_product_id_94 = null,
        private ?int $upgraded_product_id_95 = null,
        private ?int $upgraded_product_id_96 = null,
        private ?int $upgraded_product_id_97 = null,
        private ?int $upgraded_product_id_98 = null,
        private ?int $upgraded_product_id_99 = null,
        private ?int $upgraded_product_id_100 = null,
        private ?string $upgraded_product_name = null,
        private ?string $upgraded_product_name_2 = null,
        private ?string $upgraded_product_name_3 = null,
        private ?string $variant_id = null,
        private ?string $variant_name = null,
        private ?float $vat_rate = null,
        private ?string $voucher_code = null,
        private ?string $used_coupon_code = null,
        private ?int $used_coupon_id = null
    ) {
    }

    public static function fromPost(): self
    {
        return DtoHelper::fromPost(self::class);
    }
    
    public static function fromGet(): self
    {
        return DtoHelper::fromGet(self::class);
    }

    public static function map(): self
    {
        return DtoHelper::fromRequest(self::class);
    }

    public function getAction(): ?string
    {
        return $this->action;
    }

    public function getAddressCity(): ?string
    {
        return $this->address_city;
    }

    public function getAddressCompany(): ?string
    {
        return $this->address_company;
    }

    public function getAddressCountry(): ?string
    {
        return $this->address_country;
    }

    public function getAddressCountryName(): ?string
    {
        return $this->address_country_name;
    }

    public function getAddressEmail(): ?string
    {
        return $this->address_email;
    }

    public function getAddressFirstName(): ?string
    {
        return $this->address_first_name;
    }

    public function getAddressId(): ?string
    {
        return $this->address_id;
    }

    public function getAddressLastName(): ?string
    {
        return $this->address_last_name;
    }

    public function getAddressPhoneNo(): ?string
    {
        return $this->address_phone_no;
    }

    public function getAddressSalutation(): ?string
    {
        return $this->address_salutation;
    }

    public function getAddressState(): ?string
    {
        return $this->address_state;
    }

    public function getAddressStreet(): ?string
    {
        return $this->address_street;
    }

    public function getAddressStreet2(): ?string
    {
        return $this->address_street2;
    }

    public function getAddressStreetName(): ?string
    {
        return $this->address_street_name;
    }

    public function getAddressStreetNumber(): ?string
    {
        return $this->address_street_number;
    }

    public function getAddressTaxId(): ?string
    {
        return $this->address_tax_id;
    }

    public function getAddressTitle(): ?string
    {
        return $this->address_title;
    }

    public function getAddressZipcode(): ?string
    {
        return $this->address_zipcode;
    }

    public function getAffiliateId(): ?int
    {
        return $this->affiliate_id;
    }

    public function getAffiliateLink(): ?string
    {
        return $this->affiliate_link;
    }

    public function getAffiliateName(): ?string
    {
        return $this->affiliate_name;
    }

    public function getAmountAffiliate(): ?float
    {
        return $this->amount_affiliate;
    }

    public function getAmountBrutto(): ?float
    {
        return $this->amount_brutto;
    }

    public function getAmountCredited(): ?float
    {
        return $this->amount_credited;
    }

    public function getAmountFee(): ?float
    {
        return $this->amount_fee;
    }

    public function getAmountNetto(): ?float
    {
        return $this->amount_netto;
    }

    public function getAmountPartner(): ?float
    {
        return $this->amount_partner;
    }

    public function getAmountPayout(): ?float
    {
        return $this->amount_payout;
    }

    public function getAmountProvider(): ?float
    {
        return $this->amount_provider;
    }

    public function getAmountVendor(): ?float
    {
        return $this->amount_vendor;
    }

    public function getAmountVat(): ?float
    {
        return $this->amount_vat;
    }

    public function getBillingStatus(): ?string
    {
        return $this->billing_status;
    }

    public function getBillingStopReason(): ?string
    {
        return $this->billing_stop_reason;
    }

    public function getBillingType(): ?string
    {
        return $this->billing_type;
    }

    public function getBuyerId(): ?int
    {
        return $this->buyer_id;
    }

    public function getCampaignkey(): ?string
    {
        return $this->campaignkey;
    }

    public function getCountry(): ?string
    {
        return $this->country;
    }

    public function getCouponAmountLeft(): ?float
    {
        return $this->coupon_amount_left;
    }

    public function getCouponAmountLeft2(): ?float
    {
        return $this->coupon_amount_left_2;
    }

    public function getCouponAmountLeft3(): ?float
    {
        return $this->coupon_amount_left_3;
    }

    public function getCouponAmountLeft4(): ?float
    {
        return $this->coupon_amount_left_4;
    }

    public function getCouponAmountLeft5(): ?float
    {
        return $this->coupon_amount_left_5;
    }

    public function getCouponAmountLeft6(): ?float
    {
        return $this->coupon_amount_left_6;
    }

    public function getCouponAmountLeft7(): ?float
    {
        return $this->coupon_amount_left_7;
    }

    public function getCouponAmountLeft8(): ?float
    {
        return $this->coupon_amount_left_8;
    }

    public function getCouponAmountLeft9(): ?float
    {
        return $this->coupon_amount_left_9;
    }

    public function getCouponAmountLeft10(): ?float
    {
        return $this->coupon_amount_left_10;
    }

    public function getCouponAmountLeft11(): ?float
    {
        return $this->coupon_amount_left_11;
    }

    public function getCouponAmountLeft12(): ?float
    {
        return $this->coupon_amount_left_12;
    }

    public function getCouponAmountLeft13(): ?float
    {
        return $this->coupon_amount_left_13;
    }

    public function getCouponAmountLeft14(): ?float
    {
        return $this->coupon_amount_left_14;
    }

    public function getCouponAmountLeft15(): ?float
    {
        return $this->coupon_amount_left_15;
    }

    public function getCouponAmountLeft16(): ?float
    {
        return $this->coupon_amount_left_16;
    }

    public function getCouponAmountLeft17(): ?float
    {
        return $this->coupon_amount_left_17;
    }

    public function getCouponAmountLeft18(): ?float
    {
        return $this->coupon_amount_left_18;
    }

    public function getCouponAmountLeft19(): ?float
    {
        return $this->coupon_amount_left_19;
    }

    public function getCouponAmountLeft20(): ?float
    {
        return $this->coupon_amount_left_20;
    }

    public function getCouponAmountLeft21(): ?float
    {
        return $this->coupon_amount_left_21;
    }

    public function getCouponAmountLeft22(): ?float
    {
        return $this->coupon_amount_left_22;
    }

    public function getCouponAmountLeft23(): ?float
    {
        return $this->coupon_amount_left_23;
    }

    public function getCouponAmountLeft24(): ?float
    {
        return $this->coupon_amount_left_24;
    }

    public function getCouponAmountLeft25(): ?float
    {
        return $this->coupon_amount_left_25;
    }

    public function getCouponAmountLeft26(): ?float
    {
        return $this->coupon_amount_left_26;
    }

    public function getCouponAmountLeft27(): ?float
    {
        return $this->coupon_amount_left_27;
    }

    public function getCouponAmountLeft28(): ?float
    {
        return $this->coupon_amount_left_28;
    }

    public function getCouponAmountLeft29(): ?float
    {
        return $this->coupon_amount_left_29;
    }

    public function getCouponAmountLeft30(): ?float
    {
        return $this->coupon_amount_left_30;
    }

    public function getCouponAmountLeft31(): ?float
    {
        return $this->coupon_amount_left_31;
    }

    public function getCouponAmountLeft32(): ?float
    {
        return $this->coupon_amount_left_32;
    }

    public function getCouponAmountLeft33(): ?float
    {
        return $this->coupon_amount_left_33;
    }

    public function getCouponAmountLeft34(): ?float
    {
        return $this->coupon_amount_left_34;
    }

    public function getCouponAmountLeft35(): ?float
    {
        return $this->coupon_amount_left_35;
    }

    public function getCouponAmountLeft36(): ?float
    {
        return $this->coupon_amount_left_36;
    }

    public function getCouponAmountLeft37(): ?float
    {
        return $this->coupon_amount_left_37;
    }

    public function getCouponAmountLeft38(): ?float
    {
        return $this->coupon_amount_left_38;
    }

    public function getCouponAmountLeft39(): ?float
    {
        return $this->coupon_amount_left_39;
    }

    public function getCouponAmountLeft40(): ?float
    {
        return $this->coupon_amount_left_40;
    }

    public function getCouponAmountLeft41(): ?float
    {
        return $this->coupon_amount_left_41;
    }

    public function getCouponAmountLeft42(): ?float
    {
        return $this->coupon_amount_left_42;
    }

    public function getCouponAmountLeft43(): ?float
    {
        return $this->coupon_amount_left_43;
    }

    public function getCouponAmountLeft44(): ?float
    {
        return $this->coupon_amount_left_44;
    }

    public function getCouponAmountLeft45(): ?float
    {
        return $this->coupon_amount_left_45;
    }

    public function getCouponAmountLeft46(): ?float
    {
        return $this->coupon_amount_left_46;
    }

    public function getCouponAmountLeft47(): ?float
    {
        return $this->coupon_amount_left_47;
    }

    public function getCouponAmountLeft48(): ?float
    {
        return $this->coupon_amount_left_48;
    }

    public function getCouponAmountLeft49(): ?float
    {
        return $this->coupon_amount_left_49;
    }

    public function getCouponAmountLeft50(): ?float
    {
        return $this->coupon_amount_left_50;
    }

    public function getCouponAmountLeft51(): ?float
    {
        return $this->coupon_amount_left_51;
    }

    public function getCouponAmountLeft52(): ?float
    {
        return $this->coupon_amount_left_52;
    }

    public function getCouponAmountLeft53(): ?float
    {
        return $this->coupon_amount_left_53;
    }

    public function getCouponAmountLeft54(): ?float
    {
        return $this->coupon_amount_left_54;
    }

    public function getCouponAmountLeft55(): ?float
    {
        return $this->coupon_amount_left_55;
    }

    public function getCouponAmountLeft56(): ?float
    {
        return $this->coupon_amount_left_56;
    }

    public function getCouponAmountLeft57(): ?float
    {
        return $this->coupon_amount_left_57;
    }

    public function getCouponAmountLeft58(): ?float
    {
        return $this->coupon_amount_left_58;
    }

    public function getCouponAmountLeft59(): ?float
    {
        return $this->coupon_amount_left_59;
    }

    public function getCouponAmountLeft60(): ?float
    {
        return $this->coupon_amount_left_60;
    }

    public function getCouponAmountLeft61(): ?float
    {
        return $this->coupon_amount_left_61;
    }

    public function getCouponAmountLeft62(): ?float
    {
        return $this->coupon_amount_left_62;
    }

    public function getCouponAmountLeft63(): ?float
    {
        return $this->coupon_amount_left_63;
    }

    public function getCouponAmountLeft64(): ?float
    {
        return $this->coupon_amount_left_64;
    }

    public function getCouponAmountLeft65(): ?float
    {
        return $this->coupon_amount_left_65;
    }

    public function getCouponAmountLeft66(): ?float
    {
        return $this->coupon_amount_left_66;
    }

    public function getCouponAmountLeft67(): ?float
    {
        return $this->coupon_amount_left_67;
    }

    public function getCouponAmountLeft68(): ?float
    {
        return $this->coupon_amount_left_68;
    }

    public function getCouponAmountLeft69(): ?float
    {
        return $this->coupon_amount_left_69;
    }

    public function getCouponAmountLeft70(): ?float
    {
        return $this->coupon_amount_left_70;
    }

    public function getCouponAmountLeft71(): ?float
    {
        return $this->coupon_amount_left_71;
    }

    public function getCouponAmountLeft72(): ?float
    {
        return $this->coupon_amount_left_72;
    }

    public function getCouponAmountLeft73(): ?float
    {
        return $this->coupon_amount_left_73;
    }

    public function getCouponAmountLeft74(): ?float
    {
        return $this->coupon_amount_left_74;
    }

    public function getCouponAmountLeft75(): ?float
    {
        return $this->coupon_amount_left_75;
    }

    public function getCouponAmountLeft76(): ?float
    {
        return $this->coupon_amount_left_76;
    }

    public function getCouponAmountLeft77(): ?float
    {
        return $this->coupon_amount_left_77;
    }

    public function getCouponAmountLeft78(): ?float
    {
        return $this->coupon_amount_left_78;
    }

    public function getCouponAmountLeft79(): ?float
    {
        return $this->coupon_amount_left_79;
    }

    public function getCouponAmountLeft80(): ?float
    {
        return $this->coupon_amount_left_80;
    }

    public function getCouponAmountLeft81(): ?float
    {
        return $this->coupon_amount_left_81;
    }

    public function getCouponAmountLeft82(): ?float
    {
        return $this->coupon_amount_left_82;
    }

    public function getCouponAmountLeft83(): ?float
    {
        return $this->coupon_amount_left_83;
    }

    public function getCouponAmountLeft84(): ?float
    {
        return $this->coupon_amount_left_84;
    }

    public function getCouponAmountLeft85(): ?float
    {
        return $this->coupon_amount_left_85;
    }

    public function getCouponAmountLeft86(): ?float
    {
        return $this->coupon_amount_left_86;
    }

    public function getCouponAmountLeft87(): ?float
    {
        return $this->coupon_amount_left_87;
    }

    public function getCouponAmountLeft88(): ?float
    {
        return $this->coupon_amount_left_88;
    }

    public function getCouponAmountLeft89(): ?float
    {
        return $this->coupon_amount_left_89;
    }

    public function getCouponAmountLeft90(): ?float
    {
        return $this->coupon_amount_left_90;
    }

    public function getCouponAmountLeft91(): ?float
    {
        return $this->coupon_amount_left_91;
    }

    public function getCouponAmountLeft92(): ?float
    {
        return $this->coupon_amount_left_92;
    }

    public function getCouponAmountLeft93(): ?float
    {
        return $this->coupon_amount_left_93;
    }

    public function getCouponAmountLeft94(): ?float
    {
        return $this->coupon_amount_left_94;
    }

    public function getCouponAmountLeft95(): ?float
    {
        return $this->coupon_amount_left_95;
    }

    public function getCouponAmountLeft96(): ?float
    {
        return $this->coupon_amount_left_96;
    }

    public function getCouponAmountLeft97(): ?float
    {
        return $this->coupon_amount_left_97;
    }

    public function getCouponAmountLeft98(): ?float
    {
        return $this->coupon_amount_left_98;
    }

    public function getCouponAmountLeft99(): ?float
    {
        return $this->coupon_amount_left_99;
    }

    public function getCouponAmountLeft100(): ?float
    {
        return $this->coupon_amount_left_100;
    }

    public function getCouponAmountTotal(): ?float
    {
        return $this->coupon_amount_total;
    }

    public function getCouponAmountTotal2(): ?float
    {
        return $this->coupon_amount_total_2;
    }

    public function getCouponAmountTotal3(): ?float
    {
        return $this->coupon_amount_total_3;
    }

    public function getCouponAmountTotal4(): ?float
    {
        return $this->coupon_amount_total_4;
    }

    public function getCouponAmountTotal5(): ?float
    {
        return $this->coupon_amount_total_5;
    }

    public function getCouponAmountTotal6(): ?float
    {
        return $this->coupon_amount_total_6;
    }

    public function getCouponAmountTotal7(): ?float
    {
        return $this->coupon_amount_total_7;
    }

    public function getCouponAmountTotal8(): ?float
    {
        return $this->coupon_amount_total_8;
    }

    public function getCouponAmountTotal9(): ?float
    {
        return $this->coupon_amount_total_9;
    }

    public function getCouponAmountTotal10(): ?float
    {
        return $this->coupon_amount_total_10;
    }

    public function getCouponAmountTotal11(): ?float
    {
        return $this->coupon_amount_total_11;
    }

    public function getCouponAmountTotal12(): ?float
    {
        return $this->coupon_amount_total_12;
    }

    public function getCouponAmountTotal13(): ?float
    {
        return $this->coupon_amount_total_13;
    }

    public function getCouponAmountTotal14(): ?float
    {
        return $this->coupon_amount_total_14;
    }

    public function getCouponAmountTotal15(): ?float
    {
        return $this->coupon_amount_total_15;
    }

    public function getCouponAmountTotal16(): ?float
    {
        return $this->coupon_amount_total_16;
    }

    public function getCouponAmountTotal17(): ?float
    {
        return $this->coupon_amount_total_17;
    }

    public function getCouponAmountTotal18(): ?float
    {
        return $this->coupon_amount_total_18;
    }

    public function getCouponAmountTotal19(): ?float
    {
        return $this->coupon_amount_total_19;
    }

    public function getCouponAmountTotal20(): ?float
    {
        return $this->coupon_amount_total_20;
    }

    public function getCouponAmountTotal21(): ?float
    {
        return $this->coupon_amount_total_21;
    }

    public function getCouponAmountTotal22(): ?float
    {
        return $this->coupon_amount_total_22;
    }

    public function getCouponAmountTotal23(): ?float
    {
        return $this->coupon_amount_total_23;
    }

    public function getCouponAmountTotal24(): ?float
    {
        return $this->coupon_amount_total_24;
    }

    public function getCouponAmountTotal25(): ?float
    {
        return $this->coupon_amount_total_25;
    }

    public function getCouponAmountTotal26(): ?float
    {
        return $this->coupon_amount_total_26;
    }

    public function getCouponAmountTotal27(): ?float
    {
        return $this->coupon_amount_total_27;
    }

    public function getCouponAmountTotal28(): ?float
    {
        return $this->coupon_amount_total_28;
    }

    public function getCouponAmountTotal29(): ?float
    {
        return $this->coupon_amount_total_29;
    }

    public function getCouponAmountTotal30(): ?float
    {
        return $this->coupon_amount_total_30;
    }

    public function getCouponAmountTotal31(): ?float
    {
        return $this->coupon_amount_total_31;
    }

    public function getCouponAmountTotal32(): ?float
    {
        return $this->coupon_amount_total_32;
    }

    public function getCouponAmountTotal33(): ?float
    {
        return $this->coupon_amount_total_33;
    }

    public function getCouponAmountTotal34(): ?float
    {
        return $this->coupon_amount_total_34;
    }

    public function getCouponAmountTotal35(): ?float
    {
        return $this->coupon_amount_total_35;
    }

    public function getCouponAmountTotal36(): ?float
    {
        return $this->coupon_amount_total_36;
    }

    public function getCouponAmountTotal37(): ?float
    {
        return $this->coupon_amount_total_37;
    }

    public function getCouponAmountTotal38(): ?float
    {
        return $this->coupon_amount_total_38;
    }

    public function getCouponAmountTotal39(): ?float
    {
        return $this->coupon_amount_total_39;
    }

    public function getCouponAmountTotal40(): ?float
    {
        return $this->coupon_amount_total_40;
    }

    public function getCouponAmountTotal41(): ?float
    {
        return $this->coupon_amount_total_41;
    }

    public function getCouponAmountTotal42(): ?float
    {
        return $this->coupon_amount_total_42;
    }

    public function getCouponAmountTotal43(): ?float
    {
        return $this->coupon_amount_total_43;
    }

    public function getCouponAmountTotal44(): ?float
    {
        return $this->coupon_amount_total_44;
    }

    public function getCouponAmountTotal45(): ?float
    {
        return $this->coupon_amount_total_45;
    }

    public function getCouponAmountTotal46(): ?float
    {
        return $this->coupon_amount_total_46;
    }

    public function getCouponAmountTotal47(): ?float
    {
        return $this->coupon_amount_total_47;
    }

    public function getCouponAmountTotal48(): ?float
    {
        return $this->coupon_amount_total_48;
    }

    public function getCouponAmountTotal49(): ?float
    {
        return $this->coupon_amount_total_49;
    }

    public function getCouponAmountTotal50(): ?float
    {
        return $this->coupon_amount_total_50;
    }

    public function getCouponAmountTotal51(): ?float
    {
        return $this->coupon_amount_total_51;
    }

    public function getCouponAmountTotal52(): ?float
    {
        return $this->coupon_amount_total_52;
    }

    public function getCouponAmountTotal53(): ?float
    {
        return $this->coupon_amount_total_53;
    }

    public function getCouponAmountTotal54(): ?float
    {
        return $this->coupon_amount_total_54;
    }

    public function getCouponAmountTotal55(): ?float
    {
        return $this->coupon_amount_total_55;
    }

    public function getCouponAmountTotal56(): ?float
    {
        return $this->coupon_amount_total_56;
    }

    public function getCouponAmountTotal57(): ?float
    {
        return $this->coupon_amount_total_57;
    }

    public function getCouponAmountTotal58(): ?float
    {
        return $this->coupon_amount_total_58;
    }

    public function getCouponAmountTotal59(): ?float
    {
        return $this->coupon_amount_total_59;
    }

    public function getCouponAmountTotal60(): ?float
    {
        return $this->coupon_amount_total_60;
    }

    public function getCouponAmountTotal61(): ?float
    {
        return $this->coupon_amount_total_61;
    }

    public function getCouponAmountTotal62(): ?float
    {
        return $this->coupon_amount_total_62;
    }

    public function getCouponAmountTotal63(): ?float
    {
        return $this->coupon_amount_total_63;
    }

    public function getCouponAmountTotal64(): ?float
    {
        return $this->coupon_amount_total_64;
    }

    public function getCouponAmountTotal65(): ?float
    {
        return $this->coupon_amount_total_65;
    }

    public function getCouponAmountTotal66(): ?float
    {
        return $this->coupon_amount_total_66;
    }

    public function getCouponAmountTotal67(): ?float
    {
        return $this->coupon_amount_total_67;
    }

    public function getCouponAmountTotal68(): ?float
    {
        return $this->coupon_amount_total_68;
    }

    public function getCouponAmountTotal69(): ?float
    {
        return $this->coupon_amount_total_69;
    }

    public function getCouponAmountTotal70(): ?float
    {
        return $this->coupon_amount_total_70;
    }

    public function getCouponAmountTotal71(): ?float
    {
        return $this->coupon_amount_total_71;
    }

    public function getCouponAmountTotal72(): ?float
    {
        return $this->coupon_amount_total_72;
    }

    public function getCouponAmountTotal73(): ?float
    {
        return $this->coupon_amount_total_73;
    }

    public function getCouponAmountTotal74(): ?float
    {
        return $this->coupon_amount_total_74;
    }

    public function getCouponAmountTotal75(): ?float
    {
        return $this->coupon_amount_total_75;
    }

    public function getCouponAmountTotal76(): ?float
    {
        return $this->coupon_amount_total_76;
    }

    public function getCouponAmountTotal77(): ?float
    {
        return $this->coupon_amount_total_77;
    }

    public function getCouponAmountTotal78(): ?float
    {
        return $this->coupon_amount_total_78;
    }

    public function getCouponAmountTotal79(): ?float
    {
        return $this->coupon_amount_total_79;
    }

    public function getCouponAmountTotal80(): ?float
    {
        return $this->coupon_amount_total_80;
    }

    public function getCouponAmountTotal81(): ?float
    {
        return $this->coupon_amount_total_81;
    }

    public function getCouponAmountTotal82(): ?float
    {
        return $this->coupon_amount_total_82;
    }

    public function getCouponAmountTotal83(): ?float
    {
        return $this->coupon_amount_total_83;
    }

    public function getCouponAmountTotal84(): ?float
    {
        return $this->coupon_amount_total_84;
    }

    public function getCouponAmountTotal85(): ?float
    {
        return $this->coupon_amount_total_85;
    }

    public function getCouponAmountTotal86(): ?float
    {
        return $this->coupon_amount_total_86;
    }

    public function getCouponAmountTotal87(): ?float
    {
        return $this->coupon_amount_total_87;
    }

    public function getCouponAmountTotal88(): ?float
    {
        return $this->coupon_amount_total_88;
    }

    public function getCouponAmountTotal89(): ?float
    {
        return $this->coupon_amount_total_89;
    }

    public function getCouponAmountTotal90(): ?float
    {
        return $this->coupon_amount_total_90;
    }

    public function getCouponAmountTotal91(): ?float
    {
        return $this->coupon_amount_total_91;
    }

    public function getCouponAmountTotal92(): ?float
    {
        return $this->coupon_amount_total_92;
    }

    public function getCouponAmountTotal93(): ?float
    {
        return $this->coupon_amount_total_93;
    }

    public function getCouponAmountTotal94(): ?float
    {
        return $this->coupon_amount_total_94;
    }

    public function getCouponAmountTotal95(): ?float
    {
        return $this->coupon_amount_total_95;
    }

    public function getCouponAmountTotal96(): ?float
    {
        return $this->coupon_amount_total_96;
    }

    public function getCouponAmountTotal97(): ?float
    {
        return $this->coupon_amount_total_97;
    }

    public function getCouponAmountTotal98(): ?float
    {
        return $this->coupon_amount_total_98;
    }

    public function getCouponAmountTotal99(): ?float
    {
        return $this->coupon_amount_total_99;
    }

    public function getCouponAmountTotal100(): ?float
    {
        return $this->coupon_amount_total_100;
    }

    public function getCouponCode(): ?string
    {
        return $this->coupon_code;
    }

    public function getCouponCode2(): ?string
    {
        return $this->coupon_code_2;
    }

    public function getCouponCode3(): ?string
    {
        return $this->coupon_code_3;
    }

    public function getCouponCode4(): ?string
    {
        return $this->coupon_code_4;
    }

    public function getCouponCode5(): ?string
    {
        return $this->coupon_code_5;
    }

    public function getCouponCode6(): ?string
    {
        return $this->coupon_code_6;
    }

    public function getCouponCode7(): ?string
    {
        return $this->coupon_code_7;
    }

    public function getCouponCode8(): ?string
    {
        return $this->coupon_code_8;
    }

    public function getCouponCode9(): ?string
    {
        return $this->coupon_code_9;
    }

    public function getCouponCode10(): ?string
    {
        return $this->coupon_code_10;
    }

    public function getCouponCode11(): ?string
    {
        return $this->coupon_code_11;
    }

    public function getCouponCode12(): ?string
    {
        return $this->coupon_code_12;
    }

    public function getCouponCode13(): ?string
    {
        return $this->coupon_code_13;
    }

    public function getCouponCode14(): ?string
    {
        return $this->coupon_code_14;
    }

    public function getCouponCode15(): ?string
    {
        return $this->coupon_code_15;
    }

    public function getCouponCode16(): ?string
    {
        return $this->coupon_code_16;
    }

    public function getCouponCode17(): ?string
    {
        return $this->coupon_code_17;
    }

    public function getCouponCode18(): ?string
    {
        return $this->coupon_code_18;
    }

    public function getCouponCode19(): ?string
    {
        return $this->coupon_code_19;
    }

    public function getCouponCode20(): ?string
    {
        return $this->coupon_code_20;
    }

    public function getCouponCode21(): ?string
    {
        return $this->coupon_code_21;
    }

    public function getCouponCode22(): ?string
    {
        return $this->coupon_code_22;
    }

    public function getCouponCode23(): ?string
    {
        return $this->coupon_code_23;
    }

    public function getCouponCode24(): ?string
    {
        return $this->coupon_code_24;
    }

    public function getCouponCode25(): ?string
    {
        return $this->coupon_code_25;
    }

    public function getCouponCode26(): ?string
    {
        return $this->coupon_code_26;
    }

    public function getCouponCode27(): ?string
    {
        return $this->coupon_code_27;
    }

    public function getCouponCode28(): ?string
    {
        return $this->coupon_code_28;
    }

    public function getCouponCode29(): ?string
    {
        return $this->coupon_code_29;
    }

    public function getCouponCode30(): ?string
    {
        return $this->coupon_code_30;
    }

    public function getCouponCode31(): ?string
    {
        return $this->coupon_code_31;
    }

    public function getCouponCode32(): ?string
    {
        return $this->coupon_code_32;
    }

    public function getCouponCode33(): ?string
    {
        return $this->coupon_code_33;
    }

    public function getCouponCode34(): ?string
    {
        return $this->coupon_code_34;
    }

    public function getCouponCode35(): ?string
    {
        return $this->coupon_code_35;
    }

    public function getCouponCode36(): ?string
    {
        return $this->coupon_code_36;
    }

    public function getCouponCode37(): ?string
    {
        return $this->coupon_code_37;
    }

    public function getCouponCode38(): ?string
    {
        return $this->coupon_code_38;
    }

    public function getCouponCode39(): ?string
    {
        return $this->coupon_code_39;
    }

    public function getCouponCode40(): ?string
    {
        return $this->coupon_code_40;
    }

    public function getCouponCode41(): ?string
    {
        return $this->coupon_code_41;
    }

    public function getCouponCode42(): ?string
    {
        return $this->coupon_code_42;
    }

    public function getCouponCode43(): ?string
    {
        return $this->coupon_code_43;
    }

    public function getCouponCode44(): ?string
    {
        return $this->coupon_code_44;
    }

    public function getCouponCode45(): ?string
    {
        return $this->coupon_code_45;
    }

    public function getCouponCode46(): ?string
    {
        return $this->coupon_code_46;
    }

    public function getCouponCode47(): ?string
    {
        return $this->coupon_code_47;
    }

    public function getCouponCode48(): ?string
    {
        return $this->coupon_code_48;
    }

    public function getCouponCode49(): ?string
    {
        return $this->coupon_code_49;
    }

    public function getCouponCode50(): ?string
    {
        return $this->coupon_code_50;
    }

    public function getCouponCode51(): ?string
    {
        return $this->coupon_code_51;
    }

    public function getCouponCode52(): ?string
    {
        return $this->coupon_code_52;
    }

    public function getCouponCode53(): ?string
    {
        return $this->coupon_code_53;
    }

    public function getCouponCode54(): ?string
    {
        return $this->coupon_code_54;
    }

    public function getCouponCode55(): ?string
    {
        return $this->coupon_code_55;
    }

    public function getCouponCode56(): ?string
    {
        return $this->coupon_code_56;
    }

    public function getCouponCode57(): ?string
    {
        return $this->coupon_code_57;
    }

    public function getCouponCode58(): ?string
    {
        return $this->coupon_code_58;
    }

    public function getCouponCode59(): ?string
    {
        return $this->coupon_code_59;
    }

    public function getCouponCode60(): ?string
    {
        return $this->coupon_code_60;
    }

    public function getCouponCode61(): ?string
    {
        return $this->coupon_code_61;
    }

    public function getCouponCode62(): ?string
    {
        return $this->coupon_code_62;
    }

    public function getCouponCode63(): ?string
    {
        return $this->coupon_code_63;
    }

    public function getCouponCode64(): ?string
    {
        return $this->coupon_code_64;
    }

    public function getCouponCode65(): ?string
    {
        return $this->coupon_code_65;
    }

    public function getCouponCode66(): ?string
    {
        return $this->coupon_code_66;
    }

    public function getCouponCode67(): ?string
    {
        return $this->coupon_code_67;
    }

    public function getCouponCode68(): ?string
    {
        return $this->coupon_code_68;
    }

    public function getCouponCode69(): ?string
    {
        return $this->coupon_code_69;
    }

    public function getCouponCode70(): ?string
    {
        return $this->coupon_code_70;
    }

    public function getCouponCode71(): ?string
    {
        return $this->coupon_code_71;
    }

    public function getCouponCode72(): ?string
    {
        return $this->coupon_code_72;
    }

    public function getCouponCode73(): ?string
    {
        return $this->coupon_code_73;
    }

    public function getCouponCode74(): ?string
    {
        return $this->coupon_code_74;
    }

    public function getCouponCode75(): ?string
    {
        return $this->coupon_code_75;
    }

    public function getCouponCode76(): ?string
    {
        return $this->coupon_code_76;
    }

    public function getCouponCode77(): ?string
    {
        return $this->coupon_code_77;
    }

    public function getCouponCode78(): ?string
    {
        return $this->coupon_code_78;
    }

    public function getCouponCode79(): ?string
    {
        return $this->coupon_code_79;
    }

    public function getCouponCode80(): ?string
    {
        return $this->coupon_code_80;
    }

    public function getCouponCode81(): ?string
    {
        return $this->coupon_code_81;
    }

    public function getCouponCode82(): ?string
    {
        return $this->coupon_code_82;
    }

    public function getCouponCode83(): ?string
    {
        return $this->coupon_code_83;
    }

    public function getCouponCode84(): ?string
    {
        return $this->coupon_code_84;
    }

    public function getCouponCode85(): ?string
    {
        return $this->coupon_code_85;
    }

    public function getCouponCode86(): ?string
    {
        return $this->coupon_code_86;
    }

    public function getCouponCode87(): ?string
    {
        return $this->coupon_code_87;
    }

    public function getCouponCode88(): ?string
    {
        return $this->coupon_code_88;
    }

    public function getCouponCode89(): ?string
    {
        return $this->coupon_code_89;
    }

    public function getCouponCode90(): ?string
    {
        return $this->coupon_code_90;
    }

    public function getCouponCode91(): ?string
    {
        return $this->coupon_code_91;
    }

    public function getCouponCode92(): ?string
    {
        return $this->coupon_code_92;
    }

    public function getCouponCode93(): ?string
    {
        return $this->coupon_code_93;
    }

    public function getCouponCode94(): ?string
    {
        return $this->coupon_code_94;
    }

    public function getCouponCode95(): ?string
    {
        return $this->coupon_code_95;
    }

    public function getCouponCode96(): ?string
    {
        return $this->coupon_code_96;
    }

    public function getCouponCode97(): ?string
    {
        return $this->coupon_code_97;
    }

    public function getCouponCode98(): ?string
    {
        return $this->coupon_code_98;
    }

    public function getCouponCode99(): ?string
    {
        return $this->coupon_code_99;
    }

    public function getCouponCode100(): ?string
    {
        return $this->coupon_code_100;
    }

    public function getCouponCurrency(): ?string
    {
        return $this->coupon_currency;
    }

    public function getCouponCurrency2(): ?string
    {
        return $this->coupon_currency_2;
    }

    public function getCouponCurrency3(): ?string
    {
        return $this->coupon_currency_3;
    }

    public function getCouponCurrency4(): ?string
    {
        return $this->coupon_currency_4;
    }

    public function getCouponCurrency5(): ?string
    {
        return $this->coupon_currency_5;
    }

    public function getCouponCurrency6(): ?string
    {
        return $this->coupon_currency_6;
    }

    public function getCouponCurrency7(): ?string
    {
        return $this->coupon_currency_7;
    }

    public function getCouponCurrency8(): ?string
    {
        return $this->coupon_currency_8;
    }

    public function getCouponCurrency9(): ?string
    {
        return $this->coupon_currency_9;
    }

    public function getCouponCurrency10(): ?string
    {
        return $this->coupon_currency_10;
    }

    public function getCouponCurrency11(): ?string
    {
        return $this->coupon_currency_11;
    }

    public function getCouponCurrency12(): ?string
    {
        return $this->coupon_currency_12;
    }

    public function getCouponCurrency13(): ?string
    {
        return $this->coupon_currency_13;
    }

    public function getCouponCurrency14(): ?string
    {
        return $this->coupon_currency_14;
    }

    public function getCouponCurrency15(): ?string
    {
        return $this->coupon_currency_15;
    }

    public function getCouponCurrency16(): ?string
    {
        return $this->coupon_currency_16;
    }

    public function getCouponCurrency17(): ?string
    {
        return $this->coupon_currency_17;
    }

    public function getCouponCurrency18(): ?string
    {
        return $this->coupon_currency_18;
    }

    public function getCouponCurrency19(): ?string
    {
        return $this->coupon_currency_19;
    }

    public function getCouponCurrency20(): ?string
    {
        return $this->coupon_currency_20;
    }

    public function getCouponCurrency21(): ?string
    {
        return $this->coupon_currency_21;
    }

    public function getCouponCurrency22(): ?string
    {
        return $this->coupon_currency_22;
    }

    public function getCouponCurrency23(): ?string
    {
        return $this->coupon_currency_23;
    }

    public function getCouponCurrency24(): ?string
    {
        return $this->coupon_currency_24;
    }

    public function getCouponCurrency25(): ?string
    {
        return $this->coupon_currency_25;
    }

    public function getCouponCurrency26(): ?string
    {
        return $this->coupon_currency_26;
    }

    public function getCouponCurrency27(): ?string
    {
        return $this->coupon_currency_27;
    }

    public function getCouponCurrency28(): ?string
    {
        return $this->coupon_currency_28;
    }

    public function getCouponCurrency29(): ?string
    {
        return $this->coupon_currency_29;
    }

    public function getCouponCurrency30(): ?string
    {
        return $this->coupon_currency_30;
    }

    public function getCouponCurrency31(): ?string
    {
        return $this->coupon_currency_31;
    }

    public function getCouponCurrency32(): ?string
    {
        return $this->coupon_currency_32;
    }

    public function getCouponCurrency33(): ?string
    {
        return $this->coupon_currency_33;
    }

    public function getCouponCurrency34(): ?string
    {
        return $this->coupon_currency_34;
    }

    public function getCouponCurrency35(): ?string
    {
        return $this->coupon_currency_35;
    }

    public function getCouponCurrency36(): ?string
    {
        return $this->coupon_currency_36;
    }

    public function getCouponCurrency37(): ?string
    {
        return $this->coupon_currency_37;
    }

    public function getCouponCurrency38(): ?string
    {
        return $this->coupon_currency_38;
    }

    public function getCouponCurrency39(): ?string
    {
        return $this->coupon_currency_39;
    }

    public function getCouponCurrency40(): ?string
    {
        return $this->coupon_currency_40;
    }

    public function getCouponCurrency41(): ?string
    {
        return $this->coupon_currency_41;
    }

    public function getCouponCurrency42(): ?string
    {
        return $this->coupon_currency_42;
    }

    public function getCouponCurrency43(): ?string
    {
        return $this->coupon_currency_43;
    }

    public function getCouponCurrency44(): ?string
    {
        return $this->coupon_currency_44;
    }

    public function getCouponCurrency45(): ?string
    {
        return $this->coupon_currency_45;
    }

    public function getCouponCurrency46(): ?string
    {
        return $this->coupon_currency_46;
    }

    public function getCouponCurrency47(): ?string
    {
        return $this->coupon_currency_47;
    }

    public function getCouponCurrency48(): ?string
    {
        return $this->coupon_currency_48;
    }

    public function getCouponCurrency49(): ?string
    {
        return $this->coupon_currency_49;
    }

    public function getCouponCurrency50(): ?string
    {
        return $this->coupon_currency_50;
    }

    public function getCouponCurrency51(): ?string
    {
        return $this->coupon_currency_51;
    }

    public function getCouponCurrency52(): ?string
    {
        return $this->coupon_currency_52;
    }

    public function getCouponCurrency53(): ?string
    {
        return $this->coupon_currency_53;
    }

    public function getCouponCurrency54(): ?string
    {
        return $this->coupon_currency_54;
    }

    public function getCouponCurrency55(): ?string
    {
        return $this->coupon_currency_55;
    }

    public function getCouponCurrency56(): ?string
    {
        return $this->coupon_currency_56;
    }

    public function getCouponCurrency57(): ?string
    {
        return $this->coupon_currency_57;
    }

    public function getCouponCurrency58(): ?string
    {
        return $this->coupon_currency_58;
    }

    public function getCouponCurrency59(): ?string
    {
        return $this->coupon_currency_59;
    }

    public function getCouponCurrency60(): ?string
    {
        return $this->coupon_currency_60;
    }

    public function getCouponCurrency61(): ?string
    {
        return $this->coupon_currency_61;
    }

    public function getCouponCurrency62(): ?string
    {
        return $this->coupon_currency_62;
    }

    public function getCouponCurrency63(): ?string
    {
        return $this->coupon_currency_63;
    }

    public function getCouponCurrency64(): ?string
    {
        return $this->coupon_currency_64;
    }

    public function getCouponCurrency65(): ?string
    {
        return $this->coupon_currency_65;
    }

    public function getCouponCurrency66(): ?string
    {
        return $this->coupon_currency_66;
    }

    public function getCouponCurrency67(): ?string
    {
        return $this->coupon_currency_67;
    }

    public function getCouponCurrency68(): ?string
    {
        return $this->coupon_currency_68;
    }

    public function getCouponCurrency69(): ?string
    {
        return $this->coupon_currency_69;
    }

    public function getCouponCurrency70(): ?string
    {
        return $this->coupon_currency_70;
    }

    public function getCouponCurrency71(): ?string
    {
        return $this->coupon_currency_71;
    }

    public function getCouponCurrency72(): ?string
    {
        return $this->coupon_currency_72;
    }

    public function getCouponCurrency73(): ?string
    {
        return $this->coupon_currency_73;
    }

    public function getCouponCurrency74(): ?string
    {
        return $this->coupon_currency_74;
    }

    public function getCouponCurrency75(): ?string
    {
        return $this->coupon_currency_75;
    }

    public function getCouponCurrency76(): ?string
    {
        return $this->coupon_currency_76;
    }

    public function getCouponCurrency77(): ?string
    {
        return $this->coupon_currency_77;
    }

    public function getCouponCurrency78(): ?string
    {
        return $this->coupon_currency_78;
    }

    public function getCouponCurrency79(): ?string
    {
        return $this->coupon_currency_79;
    }

    public function getCouponCurrency80(): ?string
    {
        return $this->coupon_currency_80;
    }

    public function getCouponCurrency81(): ?string
    {
        return $this->coupon_currency_81;
    }

    public function getCouponCurrency82(): ?string
    {
        return $this->coupon_currency_82;
    }

    public function getCouponCurrency83(): ?string
    {
        return $this->coupon_currency_83;
    }

    public function getCouponCurrency84(): ?string
    {
        return $this->coupon_currency_84;
    }

    public function getCouponCurrency85(): ?string
    {
        return $this->coupon_currency_85;
    }

    public function getCouponCurrency86(): ?string
    {
        return $this->coupon_currency_86;
    }

    public function getCouponCurrency87(): ?string
    {
        return $this->coupon_currency_87;
    }

    public function getCouponCurrency88(): ?string
    {
        return $this->coupon_currency_88;
    }

    public function getCouponCurrency89(): ?string
    {
        return $this->coupon_currency_89;
    }

    public function getCouponCurrency90(): ?string
    {
        return $this->coupon_currency_90;
    }

    public function getCouponCurrency91(): ?string
    {
        return $this->coupon_currency_91;
    }

    public function getCouponCurrency92(): ?string
    {
        return $this->coupon_currency_92;
    }

    public function getCouponCurrency93(): ?string
    {
        return $this->coupon_currency_93;
    }

    public function getCouponCurrency94(): ?string
    {
        return $this->coupon_currency_94;
    }

    public function getCouponCurrency95(): ?string
    {
        return $this->coupon_currency_95;
    }

    public function getCouponCurrency96(): ?string
    {
        return $this->coupon_currency_96;
    }

    public function getCouponCurrency97(): ?string
    {
        return $this->coupon_currency_97;
    }

    public function getCouponCurrency98(): ?string
    {
        return $this->coupon_currency_98;
    }

    public function getCouponCurrency99(): ?string
    {
        return $this->coupon_currency_99;
    }

    public function getCouponCurrency100(): ?string
    {
        return $this->coupon_currency_100;
    }

    public function getCouponId(): ?int
    {
        return $this->coupon_id;
    }

    public function getCurrency(): ?string
    {
        return $this->currency;
    }

    public function getCustom(): ?string
    {
        return $this->custom;
    }

    public function getCustomKey(): ?string
    {
        return $this->custom_key;
    }

    public function getCustomerAffiliateName(): ?string
    {
        return $this->customer_affiliate_name;
    }

    public function getCustomerAffiliatePromoUrl(): ?string
    {
        return $this->customer_affiliate_promo_url;
    }

    public function getCustomerAffiliateUrl(): ?string
    {
        return $this->customer_affiliate_url;
    }

    public function getCustomerToAffiliateUrl(): ?string
    {
        return $this->customer_to_affiliate_url;
    }

    public function getDeliveryDate(): ?string
    {
        return $this->delivery_date;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function getEvent(): ?string
    {
        return $this->event;
    }

    public function getEticketCode(): ?int
    {
        return $this->eticket_code;
    }

    public function getEticketCount(): ?int
    {
        return $this->eticket_count;
    }

    public function getEticketCreatedAt(): ?string
    {
        return $this->eticket_created_at;
    }

    public function getEticketDate(): ?string
    {
        return $this->eticket_date;
    }

    public function getEticketDate2(): ?string
    {
        return $this->eticket_date_2;
    }

    public function getEticketDate3(): ?string
    {
        return $this->eticket_date_3;
    }

    public function getEticketDate4(): ?string
    {
        return $this->eticket_date_4;
    }

    public function getEticketDate5(): ?string
    {
        return $this->eticket_date_5;
    }

    public function getEticketDate6(): ?string
    {
        return $this->eticket_date_6;
    }

    public function getEticketDate7(): ?string
    {
        return $this->eticket_date_7;
    }

    public function getEticketDate8(): ?string
    {
        return $this->eticket_date_8;
    }

    public function getEticketDate9(): ?string
    {
        return $this->eticket_date_9;
    }

    public function getEticketDate10(): ?string
    {
        return $this->eticket_date_10;
    }

    public function getEticketDate11(): ?string
    {
        return $this->eticket_date_11;
    }

    public function getEticketDate12(): ?string
    {
        return $this->eticket_date_12;
    }

    public function getEticketDate13(): ?string
    {
        return $this->eticket_date_13;
    }

    public function getEticketDate14(): ?string
    {
        return $this->eticket_date_14;
    }

    public function getEticketDate15(): ?string
    {
        return $this->eticket_date_15;
    }

    public function getEticketDate16(): ?string
    {
        return $this->eticket_date_16;
    }

    public function getEticketDate17(): ?string
    {
        return $this->eticket_date_17;
    }

    public function getEticketDate18(): ?string
    {
        return $this->eticket_date_18;
    }

    public function getEticketDate19(): ?string
    {
        return $this->eticket_date_19;
    }

    public function getEticketDate20(): ?string
    {
        return $this->eticket_date_20;
    }

    public function getEticketDate21(): ?string
    {
        return $this->eticket_date_21;
    }

    public function getEticketDate22(): ?string
    {
        return $this->eticket_date_22;
    }

    public function getEticketDate23(): ?string
    {
        return $this->eticket_date_23;
    }

    public function getEticketDate24(): ?string
    {
        return $this->eticket_date_24;
    }

    public function getEticketDate25(): ?string
    {
        return $this->eticket_date_25;
    }

    public function getEticketDate26(): ?string
    {
        return $this->eticket_date_26;
    }

    public function getEticketDate27(): ?string
    {
        return $this->eticket_date_27;
    }

    public function getEticketDate28(): ?string
    {
        return $this->eticket_date_28;
    }

    public function getEticketDate29(): ?string
    {
        return $this->eticket_date_29;
    }

    public function getEticketDate30(): ?string
    {
        return $this->eticket_date_30;
    }

    public function getEticketDate31(): ?string
    {
        return $this->eticket_date_31;
    }

    public function getEticketDate32(): ?string
    {
        return $this->eticket_date_32;
    }

    public function getEticketDate33(): ?string
    {
        return $this->eticket_date_33;
    }

    public function getEticketDate34(): ?string
    {
        return $this->eticket_date_34;
    }

    public function getEticketDate35(): ?string
    {
        return $this->eticket_date_35;
    }

    public function getEticketDate36(): ?string
    {
        return $this->eticket_date_36;
    }

    public function getEticketDate37(): ?string
    {
        return $this->eticket_date_37;
    }

    public function getEticketDate38(): ?string
    {
        return $this->eticket_date_38;
    }

    public function getEticketDate39(): ?string
    {
        return $this->eticket_date_39;
    }

    public function getEticketDate40(): ?string
    {
        return $this->eticket_date_40;
    }

    public function getEticketDate41(): ?string
    {
        return $this->eticket_date_41;
    }

    public function getEticketDate42(): ?string
    {
        return $this->eticket_date_42;
    }

    public function getEticketDate43(): ?string
    {
        return $this->eticket_date_43;
    }

    public function getEticketDate44(): ?string
    {
        return $this->eticket_date_44;
    }

    public function getEticketDate45(): ?string
    {
        return $this->eticket_date_45;
    }

    public function getEticketDate46(): ?string
    {
        return $this->eticket_date_46;
    }

    public function getEticketDate47(): ?string
    {
        return $this->eticket_date_47;
    }

    public function getEticketDate48(): ?string
    {
        return $this->eticket_date_48;
    }

    public function getEticketDate49(): ?string
    {
        return $this->eticket_date_49;
    }

    public function getEticketDate50(): ?string
    {
        return $this->eticket_date_50;
    }

    public function getEticketDate51(): ?string
    {
        return $this->eticket_date_51;
    }

    public function getEticketDate52(): ?string
    {
        return $this->eticket_date_52;
    }

    public function getEticketDate53(): ?string
    {
        return $this->eticket_date_53;
    }

    public function getEticketDate54(): ?string
    {
        return $this->eticket_date_54;
    }

    public function getEticketDate55(): ?string
    {
        return $this->eticket_date_55;
    }

    public function getEticketDate56(): ?string
    {
        return $this->eticket_date_56;
    }

    public function getEticketDate57(): ?string
    {
        return $this->eticket_date_57;
    }

    public function getEticketDate58(): ?string
    {
        return $this->eticket_date_58;
    }

    public function getEticketDate59(): ?string
    {
        return $this->eticket_date_59;
    }

    public function getEticketDate60(): ?string
    {
        return $this->eticket_date_60;
    }

    public function getEticketDate61(): ?string
    {
        return $this->eticket_date_61;
    }

    public function getEticketDate62(): ?string
    {
        return $this->eticket_date_62;
    }

    public function getEticketDate63(): ?string
    {
        return $this->eticket_date_63;
    }

    public function getEticketDate64(): ?string
    {
        return $this->eticket_date_64;
    }

    public function getEticketDate65(): ?string
    {
        return $this->eticket_date_65;
    }

    public function getEticketDate66(): ?string
    {
        return $this->eticket_date_66;
    }

    public function getEticketDate67(): ?string
    {
        return $this->eticket_date_67;
    }

    public function getEticketDate68(): ?string
    {
        return $this->eticket_date_68;
    }

    public function getEticketDate69(): ?string
    {
        return $this->eticket_date_69;
    }

    public function getEticketDate70(): ?string
    {
        return $this->eticket_date_70;
    }

    public function getEticketDate71(): ?string
    {
        return $this->eticket_date_71;
    }

    public function getEticketDate72(): ?string
    {
        return $this->eticket_date_72;
    }

    public function getEticketDate73(): ?string
    {
        return $this->eticket_date_73;
    }

    public function getEticketDate74(): ?string
    {
        return $this->eticket_date_74;
    }

    public function getEticketDate75(): ?string
    {
        return $this->eticket_date_75;
    }

    public function getEticketDate76(): ?string
    {
        return $this->eticket_date_76;
    }

    public function getEticketDate77(): ?string
    {
        return $this->eticket_date_77;
    }

    public function getEticketDate78(): ?string
    {
        return $this->eticket_date_78;
    }

    public function getEticketDate79(): ?string
    {
        return $this->eticket_date_79;
    }

    public function getEticketDate80(): ?string
    {
        return $this->eticket_date_80;
    }

    public function getEticketDate81(): ?string
    {
        return $this->eticket_date_81;
    }

    public function getEticketDate82(): ?string
    {
        return $this->eticket_date_82;
    }

    public function getEticketDate83(): ?string
    {
        return $this->eticket_date_83;
    }

    public function getEticketDate84(): ?string
    {
        return $this->eticket_date_84;
    }

    public function getEticketDate85(): ?string
    {
        return $this->eticket_date_85;
    }

    public function getEticketDate86(): ?string
    {
        return $this->eticket_date_86;
    }

    public function getEticketDate87(): ?string
    {
        return $this->eticket_date_87;
    }

    public function getEticketDate88(): ?string
    {
        return $this->eticket_date_88;
    }

    public function getEticketDate89(): ?string
    {
        return $this->eticket_date_89;
    }

    public function getEticketDate90(): ?string
    {
        return $this->eticket_date_90;
    }

    public function getEticketDate91(): ?string
    {
        return $this->eticket_date_91;
    }

    public function getEticketDate92(): ?string
    {
        return $this->eticket_date_92;
    }

    public function getEticketDate93(): ?string
    {
        return $this->eticket_date_93;
    }

    public function getEticketDate94(): ?string
    {
        return $this->eticket_date_94;
    }

    public function getEticketDate95(): ?string
    {
        return $this->eticket_date_95;
    }

    public function getEticketDate96(): ?string
    {
        return $this->eticket_date_96;
    }

    public function getEticketDate97(): ?string
    {
        return $this->eticket_date_97;
    }

    public function getEticketDate98(): ?string
    {
        return $this->eticket_date_98;
    }

    public function getEticketDate99(): ?string
    {
        return $this->eticket_date_99;
    }

    public function getEticketDate100(): ?string
    {
        return $this->eticket_date_100;
    }

    public function getEticketHint(): ?string
    {
        return $this->eticket_hint;
    }

    public function getEticketHint2(): ?string
    {
        return $this->eticket_hint_2;
    }

    public function getEticketHint3(): ?string
    {
        return $this->eticket_hint_3;
    }

    public function getEticketHint4(): ?string
    {
        return $this->eticket_hint_4;
    }

    public function getEticketHint5(): ?string
    {
        return $this->eticket_hint_5;
    }

    public function getEticketHint6(): ?string
    {
        return $this->eticket_hint_6;
    }

    public function getEticketHint7(): ?string
    {
        return $this->eticket_hint_7;
    }

    public function getEticketHint8(): ?string
    {
        return $this->eticket_hint_8;
    }

    public function getEticketHint9(): ?string
    {
        return $this->eticket_hint_9;
    }

    public function getEticketHint10(): ?string
    {
        return $this->eticket_hint_10;
    }

    public function getEticketHint11(): ?string
    {
        return $this->eticket_hint_11;
    }

    public function getEticketHint12(): ?string
    {
        return $this->eticket_hint_12;
    }

    public function getEticketHint13(): ?string
    {
        return $this->eticket_hint_13;
    }

    public function getEticketHint14(): ?string
    {
        return $this->eticket_hint_14;
    }

    public function getEticketHint15(): ?string
    {
        return $this->eticket_hint_15;
    }

    public function getEticketHint16(): ?string
    {
        return $this->eticket_hint_16;
    }

    public function getEticketHint17(): ?string
    {
        return $this->eticket_hint_17;
    }

    public function getEticketHint18(): ?string
    {
        return $this->eticket_hint_18;
    }

    public function getEticketHint19(): ?string
    {
        return $this->eticket_hint_19;
    }

    public function getEticketHint20(): ?string
    {
        return $this->eticket_hint_20;
    }

    public function getEticketHint21(): ?string
    {
        return $this->eticket_hint_21;
    }

    public function getEticketHint22(): ?string
    {
        return $this->eticket_hint_22;
    }

    public function getEticketHint23(): ?string
    {
        return $this->eticket_hint_23;
    }

    public function getEticketHint24(): ?string
    {
        return $this->eticket_hint_24;
    }

    public function getEticketHint25(): ?string
    {
        return $this->eticket_hint_25;
    }

    public function getEticketHint26(): ?string
    {
        return $this->eticket_hint_26;
    }

    public function getEticketHint27(): ?string
    {
        return $this->eticket_hint_27;
    }

    public function getEticketHint28(): ?string
    {
        return $this->eticket_hint_28;
    }

    public function getEticketHint29(): ?string
    {
        return $this->eticket_hint_29;
    }

    public function getEticketHint30(): ?string
    {
        return $this->eticket_hint_30;
    }

    public function getEticketHint31(): ?string
    {
        return $this->eticket_hint_31;
    }

    public function getEticketHint32(): ?string
    {
        return $this->eticket_hint_32;
    }

    public function getEticketHint33(): ?string
    {
        return $this->eticket_hint_33;
    }

    public function getEticketHint34(): ?string
    {
        return $this->eticket_hint_34;
    }

    public function getEticketHint35(): ?string
    {
        return $this->eticket_hint_35;
    }

    public function getEticketHint36(): ?string
    {
        return $this->eticket_hint_36;
    }

    public function getEticketHint37(): ?string
    {
        return $this->eticket_hint_37;
    }

    public function getEticketHint38(): ?string
    {
        return $this->eticket_hint_38;
    }

    public function getEticketHint39(): ?string
    {
        return $this->eticket_hint_39;
    }

    public function getEticketHint40(): ?string
    {
        return $this->eticket_hint_40;
    }

    public function getEticketHint41(): ?string
    {
        return $this->eticket_hint_41;
    }

    public function getEticketHint42(): ?string
    {
        return $this->eticket_hint_42;
    }

    public function getEticketHint43(): ?string
    {
        return $this->eticket_hint_43;
    }

    public function getEticketHint44(): ?string
    {
        return $this->eticket_hint_44;
    }

    public function getEticketHint45(): ?string
    {
        return $this->eticket_hint_45;
    }

    public function getEticketHint46(): ?string
    {
        return $this->eticket_hint_46;
    }

    public function getEticketHint47(): ?string
    {
        return $this->eticket_hint_47;
    }

    public function getEticketHint48(): ?string
    {
        return $this->eticket_hint_48;
    }

    public function getEticketHint49(): ?string
    {
        return $this->eticket_hint_49;
    }

    public function getEticketHint50(): ?string
    {
        return $this->eticket_hint_50;
    }

    public function getEticketHint51(): ?string
    {
        return $this->eticket_hint_51;
    }

    public function getEticketHint52(): ?string
    {
        return $this->eticket_hint_52;
    }

    public function getEticketHint53(): ?string
    {
        return $this->eticket_hint_53;
    }

    public function getEticketHint54(): ?string
    {
        return $this->eticket_hint_54;
    }

    public function getEticketHint55(): ?string
    {
        return $this->eticket_hint_55;
    }

    public function getEticketHint56(): ?string
    {
        return $this->eticket_hint_56;
    }

    public function getEticketHint57(): ?string
    {
        return $this->eticket_hint_57;
    }

    public function getEticketHint58(): ?string
    {
        return $this->eticket_hint_58;
    }

    public function getEticketHint59(): ?string
    {
        return $this->eticket_hint_59;
    }

    public function getEticketHint60(): ?string
    {
        return $this->eticket_hint_60;
    }

    public function getEticketHint61(): ?string
    {
        return $this->eticket_hint_61;
    }

    public function getEticketHint62(): ?string
    {
        return $this->eticket_hint_62;
    }

    public function getEticketHint63(): ?string
    {
        return $this->eticket_hint_63;
    }

    public function getEticketHint64(): ?string
    {
        return $this->eticket_hint_64;
    }

    public function getEticketHint65(): ?string
    {
        return $this->eticket_hint_65;
    }

    public function getEticketHint66(): ?string
    {
        return $this->eticket_hint_66;
    }

    public function getEticketHint67(): ?string
    {
        return $this->eticket_hint_67;
    }

    public function getEticketHint68(): ?string
    {
        return $this->eticket_hint_68;
    }

    public function getEticketHint69(): ?string
    {
        return $this->eticket_hint_69;
    }

    public function getEticketHint70(): ?string
    {
        return $this->eticket_hint_70;
    }

    public function getEticketHint71(): ?string
    {
        return $this->eticket_hint_71;
    }

    public function getEticketHint72(): ?string
    {
        return $this->eticket_hint_72;
    }

    public function getEticketHint73(): ?string
    {
        return $this->eticket_hint_73;
    }

    public function getEticketHint74(): ?string
    {
        return $this->eticket_hint_74;
    }

    public function getEticketHint75(): ?string
    {
        return $this->eticket_hint_75;
    }

    public function getEticketHint76(): ?string
    {
        return $this->eticket_hint_76;
    }

    public function getEticketHint77(): ?string
    {
        return $this->eticket_hint_77;
    }

    public function getEticketHint78(): ?string
    {
        return $this->eticket_hint_78;
    }

    public function getEticketHint79(): ?string
    {
        return $this->eticket_hint_79;
    }

    public function getEticketHint80(): ?string
    {
        return $this->eticket_hint_80;
    }

    public function getEticketHint81(): ?string
    {
        return $this->eticket_hint_81;
    }

    public function getEticketHint82(): ?string
    {
        return $this->eticket_hint_82;
    }

    public function getEticketHint83(): ?string
    {
        return $this->eticket_hint_83;
    }

    public function getEticketHint84(): ?string
    {
        return $this->eticket_hint_84;
    }

    public function getEticketHint85(): ?string
    {
        return $this->eticket_hint_85;
    }

    public function getEticketHint86(): ?string
    {
        return $this->eticket_hint_86;
    }

    public function getEticketHint87(): ?string
    {
        return $this->eticket_hint_87;
    }

    public function getEticketHint88(): ?string
    {
        return $this->eticket_hint_88;
    }

    public function getEticketHint89(): ?string
    {
        return $this->eticket_hint_89;
    }

    public function getEticketHint90(): ?string
    {
        return $this->eticket_hint_90;
    }

    public function getEticketHint91(): ?string
    {
        return $this->eticket_hint_91;
    }

    public function getEticketHint92(): ?string
    {
        return $this->eticket_hint_92;
    }

    public function getEticketHint93(): ?string
    {
        return $this->eticket_hint_93;
    }

    public function getEticketHint94(): ?string
    {
        return $this->eticket_hint_94;
    }

    public function getEticketHint95(): ?string
    {
        return $this->eticket_hint_95;
    }

    public function getEticketHint96(): ?string
    {
        return $this->eticket_hint_96;
    }

    public function getEticketHint97(): ?string
    {
        return $this->eticket_hint_97;
    }

    public function getEticketHint98(): ?string
    {
        return $this->eticket_hint_98;
    }

    public function getEticketHint99(): ?string
    {
        return $this->eticket_hint_99;
    }

    public function getEticketHint100(): ?string
    {
        return $this->eticket_hint_100;
    }

    public function getEticketId(): ?int
    {
        return $this->eticket_id;
    }

    public function getEticketIsBlocked(): ?string
    {
        return $this->eticket_is_blocked;
    }

    public function getEticketModifiedAt(): ?string
    {
        return $this->eticket_modified_at;
    }

    public function getEticketNo(): ?int
    {
        return $this->eticket_no;
    }

    public function getEticketUrl(): ?string
    {
        return $this->eticket_url;
    }

    public function getEticketUrl2(): ?string
    {
        return $this->eticket_url_2;
    }

    public function getEticketUrl3(): ?string
    {
        return $this->eticket_url_3;
    }

    public function getEticketUrl4(): ?string
    {
        return $this->eticket_url_4;
    }

    public function getEticketUrl5(): ?string
    {
        return $this->eticket_url_5;
    }

    public function getEticketUrl6(): ?string
    {
        return $this->eticket_url_6;
    }

    public function getEticketUrl7(): ?string
    {
        return $this->eticket_url_7;
    }

    public function getEticketUrl8(): ?string
    {
        return $this->eticket_url_8;
    }

    public function getEticketUrl9(): ?string
    {
        return $this->eticket_url_9;
    }

    public function getEticketUrl10(): ?string
    {
        return $this->eticket_url_10;
    }

    public function getEticketUrl11(): ?string
    {
        return $this->eticket_url_11;
    }

    public function getEticketUrl12(): ?string
    {
        return $this->eticket_url_12;
    }

    public function getEticketUrl13(): ?string
    {
        return $this->eticket_url_13;
    }

    public function getEticketUrl14(): ?string
    {
        return $this->eticket_url_14;
    }

    public function getEticketUrl15(): ?string
    {
        return $this->eticket_url_15;
    }

    public function getEticketUrl16(): ?string
    {
        return $this->eticket_url_16;
    }

    public function getEticketUrl17(): ?string
    {
        return $this->eticket_url_17;
    }

    public function getEticketUrl18(): ?string
    {
        return $this->eticket_url_18;
    }

    public function getEticketUrl19(): ?string
    {
        return $this->eticket_url_19;
    }

    public function getEticketUrl20(): ?string
    {
        return $this->eticket_url_20;
    }

    public function getEticketUrl21(): ?string
    {
        return $this->eticket_url_21;
    }

    public function getEticketUrl22(): ?string
    {
        return $this->eticket_url_22;
    }

    public function getEticketUrl23(): ?string
    {
        return $this->eticket_url_23;
    }

    public function getEticketUrl24(): ?string
    {
        return $this->eticket_url_24;
    }

    public function getEticketUrl25(): ?string
    {
        return $this->eticket_url_25;
    }

    public function getEticketUrl26(): ?string
    {
        return $this->eticket_url_26;
    }

    public function getEticketUrl27(): ?string
    {
        return $this->eticket_url_27;
    }

    public function getEticketUrl28(): ?string
    {
        return $this->eticket_url_28;
    }

    public function getEticketUrl29(): ?string
    {
        return $this->eticket_url_29;
    }

    public function getEticketUrl30(): ?string
    {
        return $this->eticket_url_30;
    }

    public function getEticketUrl31(): ?string
    {
        return $this->eticket_url_31;
    }

    public function getEticketUrl32(): ?string
    {
        return $this->eticket_url_32;
    }

    public function getEticketUrl33(): ?string
    {
        return $this->eticket_url_33;
    }

    public function getEticketUrl34(): ?string
    {
        return $this->eticket_url_34;
    }

    public function getEticketUrl35(): ?string
    {
        return $this->eticket_url_35;
    }

    public function getEticketUrl36(): ?string
    {
        return $this->eticket_url_36;
    }

    public function getEticketUrl37(): ?string
    {
        return $this->eticket_url_37;
    }

    public function getEticketUrl38(): ?string
    {
        return $this->eticket_url_38;
    }

    public function getEticketUrl39(): ?string
    {
        return $this->eticket_url_39;
    }

    public function getEticketUrl40(): ?string
    {
        return $this->eticket_url_40;
    }

    public function getEticketUrl41(): ?string
    {
        return $this->eticket_url_41;
    }

    public function getEticketUrl42(): ?string
    {
        return $this->eticket_url_42;
    }

    public function getEticketUrl43(): ?string
    {
        return $this->eticket_url_43;
    }

    public function getEticketUrl44(): ?string
    {
        return $this->eticket_url_44;
    }

    public function getEticketUrl45(): ?string
    {
        return $this->eticket_url_45;
    }

    public function getEticketUrl46(): ?string
    {
        return $this->eticket_url_46;
    }

    public function getEticketUrl47(): ?string
    {
        return $this->eticket_url_47;
    }

    public function getEticketUrl48(): ?string
    {
        return $this->eticket_url_48;
    }

    public function getEticketUrl49(): ?string
    {
        return $this->eticket_url_49;
    }

    public function getEticketUrl50(): ?string
    {
        return $this->eticket_url_50;
    }

    public function getEticketUrl51(): ?string
    {
        return $this->eticket_url_51;
    }

    public function getEticketUrl52(): ?string
    {
        return $this->eticket_url_52;
    }

    public function getEticketUrl53(): ?string
    {
        return $this->eticket_url_53;
    }

    public function getEticketUrl54(): ?string
    {
        return $this->eticket_url_54;
    }

    public function getEticketUrl55(): ?string
    {
        return $this->eticket_url_55;
    }

    public function getEticketUrl56(): ?string
    {
        return $this->eticket_url_56;
    }

    public function getEticketUrl57(): ?string
    {
        return $this->eticket_url_57;
    }

    public function getEticketUrl58(): ?string
    {
        return $this->eticket_url_58;
    }

    public function getEticketUrl59(): ?string
    {
        return $this->eticket_url_59;
    }

    public function getEticketUrl60(): ?string
    {
        return $this->eticket_url_60;
    }

    public function getEticketUrl61(): ?string
    {
        return $this->eticket_url_61;
    }

    public function getEticketUrl62(): ?string
    {
        return $this->eticket_url_62;
    }

    public function getEticketUrl63(): ?string
    {
        return $this->eticket_url_63;
    }

    public function getEticketUrl64(): ?string
    {
        return $this->eticket_url_64;
    }

    public function getEticketUrl65(): ?string
    {
        return $this->eticket_url_65;
    }

    public function getEticketUrl66(): ?string
    {
        return $this->eticket_url_66;
    }

    public function getEticketUrl67(): ?string
    {
        return $this->eticket_url_67;
    }

    public function getEticketUrl68(): ?string
    {
        return $this->eticket_url_68;
    }

    public function getEticketUrl69(): ?string
    {
        return $this->eticket_url_69;
    }

    public function getEticketUrl70(): ?string
    {
        return $this->eticket_url_70;
    }

    public function getEticketUrl71(): ?string
    {
        return $this->eticket_url_71;
    }

    public function getEticketUrl72(): ?string
    {
        return $this->eticket_url_72;
    }

    public function getEticketUrl73(): ?string
    {
        return $this->eticket_url_73;
    }

    public function getEticketUrl74(): ?string
    {
        return $this->eticket_url_74;
    }

    public function getEticketUrl75(): ?string
    {
        return $this->eticket_url_75;
    }

    public function getEticketUrl76(): ?string
    {
        return $this->eticket_url_76;
    }

    public function getEticketUrl77(): ?string
    {
        return $this->eticket_url_77;
    }

    public function getEticketUrl78(): ?string
    {
        return $this->eticket_url_78;
    }

    public function getEticketUrl79(): ?string
    {
        return $this->eticket_url_79;
    }

    public function getEticketUrl80(): ?string
    {
        return $this->eticket_url_80;
    }

    public function getEticketUrl81(): ?string
    {
        return $this->eticket_url_81;
    }

    public function getEticketUrl82(): ?string
    {
        return $this->eticket_url_82;
    }

    public function getEticketUrl83(): ?string
    {
        return $this->eticket_url_83;
    }

    public function getEticketUrl84(): ?string
    {
        return $this->eticket_url_84;
    }

    public function getEticketUrl85(): ?string
    {
        return $this->eticket_url_85;
    }

    public function getEticketUrl86(): ?string
    {
        return $this->eticket_url_86;
    }

    public function getEticketUrl87(): ?string
    {
        return $this->eticket_url_87;
    }

    public function getEticketUrl88(): ?string
    {
        return $this->eticket_url_88;
    }

    public function getEticketUrl89(): ?string
    {
        return $this->eticket_url_89;
    }

    public function getEticketUrl90(): ?string
    {
        return $this->eticket_url_90;
    }

    public function getEticketUrl91(): ?string
    {
        return $this->eticket_url_91;
    }

    public function getEticketUrl92(): ?string
    {
        return $this->eticket_url_92;
    }

    public function getEticketUrl93(): ?string
    {
        return $this->eticket_url_93;
    }

    public function getEticketUrl94(): ?string
    {
        return $this->eticket_url_94;
    }

    public function getEticketUrl95(): ?string
    {
        return $this->eticket_url_95;
    }

    public function getEticketUrl96(): ?string
    {
        return $this->eticket_url_96;
    }

    public function getEticketUrl97(): ?string
    {
        return $this->eticket_url_97;
    }

    public function getEticketUrl98(): ?string
    {
        return $this->eticket_url_98;
    }

    public function getEticketUrl99(): ?string
    {
        return $this->eticket_url_99;
    }

    public function getEticketUrl100(): ?string
    {
        return $this->eticket_url_100;
    }

    public function getEticketUsedAt(): ?string
    {
        return $this->eticket_used_at;
    }

    public function getFirstAmount(): ?float
    {
        return $this->first_amount;
    }

    public function getFirstBillingInterval(): ?string
    {
        return $this->first_billing_interval;
    }

    public function getFirstVatAmount(): ?float
    {
        return $this->first_vat_amount;
    }

    public function getFormCount(): ?string
    {
        return $this->form_count;
    }

    public function getFormNo(): ?string
    {
        return $this->form_no;
    }

    public function getIpnConfigApiKeyId(): ?string
    {
        return $this->ipn_config_api_key_id;
    }

    public function getIpnConfigDomainId(): ?int
    {
        return $this->ipn_config_domain_id;
    }

    public function getIpnConfigId(): ?int
    {
        return $this->ipn_config_id;
    }

    public function getIpnConfigProductsIds(): ?string
    {
        return $this->ipn_config_products_ids;
    }

    public function getIpnVersion(): ?float
    {
        return $this->ipn_version;
    }

    public function getIsCancelledFor(): ?string
    {
        return $this->is_cancelled_for;
    }

    public function getIsGdprCountry(): ?string
    {
        return $this->is_gdpr_country;
    }

    public function getLanguage(): ?string
    {
        return $this->language;
    }

    public function getLicenseCreated(): ?string
    {
        return $this->license_created;
    }

    public function getLicenseDataEmail(): ?string
    {
        return $this->license_data_email;
    }

    public function getLicenseDataFirstName(): ?string
    {
        return $this->license_data_first_name;
    }

    public function getLicenseDataLastName(): ?string
    {
        return $this->license_data_last_name;
    }

    public function getLicenseDataProduct(): ?string
    {
        return $this->license_data_product;
    }

    public function getLicenseKey(): ?string
    {
        return $this->license_key;
    }

    public function getLicenseKey2(): ?string
    {
        return $this->license_key_2;
    }

    public function getLicenseKey3(): ?string
    {
        return $this->license_key_3;
    }

    public function getLicenseKey4(): ?string
    {
        return $this->license_key_4;
    }

    public function getLicenseKey5(): ?string
    {
        return $this->license_key_5;
    }

    public function getLicenseKey6(): ?string
    {
        return $this->license_key_6;
    }

    public function getLicenseKey7(): ?string
    {
        return $this->license_key_7;
    }

    public function getLicenseKey8(): ?string
    {
        return $this->license_key_8;
    }

    public function getLicenseKey9(): ?string
    {
        return $this->license_key_9;
    }

    public function getLicenseKey10(): ?string
    {
        return $this->license_key_10;
    }

    public function getLicenseKey11(): ?string
    {
        return $this->license_key_11;
    }

    public function getLicenseKey12(): ?string
    {
        return $this->license_key_12;
    }

    public function getLicenseKey13(): ?string
    {
        return $this->license_key_13;
    }

    public function getLicenseKey14(): ?string
    {
        return $this->license_key_14;
    }

    public function getLicenseKey15(): ?string
    {
        return $this->license_key_15;
    }

    public function getLicenseKey16(): ?string
    {
        return $this->license_key_16;
    }

    public function getLicenseKey17(): ?string
    {
        return $this->license_key_17;
    }

    public function getLicenseKey18(): ?string
    {
        return $this->license_key_18;
    }

    public function getLicenseKey19(): ?string
    {
        return $this->license_key_19;
    }

    public function getLicenseKey20(): ?string
    {
        return $this->license_key_20;
    }

    public function getLicenseKey21(): ?string
    {
        return $this->license_key_21;
    }

    public function getLicenseKey22(): ?string
    {
        return $this->license_key_22;
    }

    public function getLicenseKey23(): ?string
    {
        return $this->license_key_23;
    }

    public function getLicenseKey24(): ?string
    {
        return $this->license_key_24;
    }

    public function getLicenseKey25(): ?string
    {
        return $this->license_key_25;
    }

    public function getLicenseKey26(): ?string
    {
        return $this->license_key_26;
    }

    public function getLicenseKey27(): ?string
    {
        return $this->license_key_27;
    }

    public function getLicenseKey28(): ?string
    {
        return $this->license_key_28;
    }

    public function getLicenseKey29(): ?string
    {
        return $this->license_key_29;
    }

    public function getLicenseKey30(): ?string
    {
        return $this->license_key_30;
    }

    public function getLicenseKey31(): ?string
    {
        return $this->license_key_31;
    }

    public function getLicenseKey32(): ?string
    {
        return $this->license_key_32;
    }

    public function getLicenseKey33(): ?string
    {
        return $this->license_key_33;
    }

    public function getLicenseKey34(): ?string
    {
        return $this->license_key_34;
    }

    public function getLicenseKey35(): ?string
    {
        return $this->license_key_35;
    }

    public function getLicenseKey36(): ?string
    {
        return $this->license_key_36;
    }

    public function getLicenseKey37(): ?string
    {
        return $this->license_key_37;
    }

    public function getLicenseKey38(): ?string
    {
        return $this->license_key_38;
    }

    public function getLicenseKey39(): ?string
    {
        return $this->license_key_39;
    }

    public function getLicenseKey40(): ?string
    {
        return $this->license_key_40;
    }

    public function getLicenseKey41(): ?string
    {
        return $this->license_key_41;
    }

    public function getLicenseKey42(): ?string
    {
        return $this->license_key_42;
    }

    public function getLicenseKey43(): ?string
    {
        return $this->license_key_43;
    }

    public function getLicenseKey44(): ?string
    {
        return $this->license_key_44;
    }

    public function getLicenseKey45(): ?string
    {
        return $this->license_key_45;
    }

    public function getLicenseKey46(): ?string
    {
        return $this->license_key_46;
    }

    public function getLicenseKey47(): ?string
    {
        return $this->license_key_47;
    }

    public function getLicenseKey48(): ?string
    {
        return $this->license_key_48;
    }

    public function getLicenseKey49(): ?string
    {
        return $this->license_key_49;
    }

    public function getLicenseKey50(): ?string
    {
        return $this->license_key_50;
    }

    public function getLicenseKey51(): ?string
    {
        return $this->license_key_51;
    }

    public function getLicenseKey52(): ?string
    {
        return $this->license_key_52;
    }

    public function getLicenseKey53(): ?string
    {
        return $this->license_key_53;
    }

    public function getLicenseKey54(): ?string
    {
        return $this->license_key_54;
    }

    public function getLicenseKey55(): ?string
    {
        return $this->license_key_55;
    }

    public function getLicenseKey56(): ?string
    {
        return $this->license_key_56;
    }

    public function getLicenseKey57(): ?string
    {
        return $this->license_key_57;
    }

    public function getLicenseKey58(): ?string
    {
        return $this->license_key_58;
    }

    public function getLicenseKey59(): ?string
    {
        return $this->license_key_59;
    }

    public function getLicenseKey60(): ?string
    {
        return $this->license_key_60;
    }

    public function getLicenseKey61(): ?string
    {
        return $this->license_key_61;
    }

    public function getLicenseKey62(): ?string
    {
        return $this->license_key_62;
    }

    public function getLicenseKey63(): ?string
    {
        return $this->license_key_63;
    }

    public function getLicenseKey64(): ?string
    {
        return $this->license_key_64;
    }

    public function getLicenseKey65(): ?string
    {
        return $this->license_key_65;
    }

    public function getLicenseKey66(): ?string
    {
        return $this->license_key_66;
    }

    public function getLicenseKey67(): ?string
    {
        return $this->license_key_67;
    }

    public function getLicenseKey68(): ?string
    {
        return $this->license_key_68;
    }

    public function getLicenseKey69(): ?string
    {
        return $this->license_key_69;
    }

    public function getLicenseKey70(): ?string
    {
        return $this->license_key_70;
    }

    public function getLicenseKey71(): ?string
    {
        return $this->license_key_71;
    }

    public function getLicenseKey72(): ?string
    {
        return $this->license_key_72;
    }

    public function getLicenseKey73(): ?string
    {
        return $this->license_key_73;
    }

    public function getLicenseKey74(): ?string
    {
        return $this->license_key_74;
    }

    public function getLicenseKey75(): ?string
    {
        return $this->license_key_75;
    }

    public function getLicenseKey76(): ?string
    {
        return $this->license_key_76;
    }

    public function getLicenseKey77(): ?string
    {
        return $this->license_key_77;
    }

    public function getLicenseKey78(): ?string
    {
        return $this->license_key_78;
    }

    public function getLicenseKey79(): ?string
    {
        return $this->license_key_79;
    }

    public function getLicenseKey80(): ?string
    {
        return $this->license_key_80;
    }

    public function getLicenseKey81(): ?string
    {
        return $this->license_key_81;
    }

    public function getLicenseKey82(): ?string
    {
        return $this->license_key_82;
    }

    public function getLicenseKey83(): ?string
    {
        return $this->license_key_83;
    }

    public function getLicenseKey84(): ?string
    {
        return $this->license_key_84;
    }

    public function getLicenseKey85(): ?string
    {
        return $this->license_key_85;
    }

    public function getLicenseKey86(): ?string
    {
        return $this->license_key_86;
    }

    public function getLicenseKey87(): ?string
    {
        return $this->license_key_87;
    }

    public function getLicenseKey88(): ?string
    {
        return $this->license_key_88;
    }

    public function getLicenseKey89(): ?string
    {
        return $this->license_key_89;
    }

    public function getLicenseKey90(): ?string
    {
        return $this->license_key_90;
    }

    public function getLicenseKey91(): ?string
    {
        return $this->license_key_91;
    }

    public function getLicenseKey92(): ?string
    {
        return $this->license_key_92;
    }

    public function getLicenseKey93(): ?string
    {
        return $this->license_key_93;
    }

    public function getLicenseKey94(): ?string
    {
        return $this->license_key_94;
    }

    public function getLicenseKey95(): ?string
    {
        return $this->license_key_95;
    }

    public function getLicenseKey96(): ?string
    {
        return $this->license_key_96;
    }

    public function getLicenseKey97(): ?string
    {
        return $this->license_key_97;
    }

    public function getLicenseKey98(): ?string
    {
        return $this->license_key_98;
    }

    public function getLicenseKey99(): ?string
    {
        return $this->license_key_99;
    }

    public function getLicenseKey100(): ?string
    {
        return $this->license_key_100;
    }

    public function getLicenseKeyType(): ?string
    {
        return $this->license_key_type;
    }

    public function getLicenseId(): ?int
    {
        return $this->license_id;
    }

    public function getLocationAddress(): ?string
    {
        return $this->location_address;
    }

    public function getLocationCountry(): ?string
    {
        return $this->location_country;
    }

    public function getLocationDirections(): ?string
    {
        return $this->location_directions;
    }

    public function getLocationId(): ?int
    {
        return $this->location_id;
    }

    public function getLocationLatitude(): ?string
    {
        return $this->location_latitude;
    }

    public function getLocationLongitude(): ?string
    {
        return $this->location_longitude;
    }

    public function getLocationMapImageUrl(): ?string
    {
        return $this->location_map_image_url;
    }

    public function getLocationName(): ?string
    {
        return $this->location_name;
    }

    public function getLocationNote(): ?string
    {
        return $this->location_note;
    }

    public function getMerchantId(): ?int
    {
        return $this->merchant_id;
    }

    public function getMerchantName(): ?string
    {
        return $this->merchant_name;
    }

    public function getNextPaymentAt(): ?string
    {
        return $this->next_payment_at;
    }

    public function getNewsletterChoice(): ?string
    {
        return $this->newsletter_choice;
    }

    public function getNewsletterChoiceMsg(): ?string
    {
        return $this->newsletter_choice_msg;
    }

    public function getNote(): ?string
    {
        return $this->note;
    }

    public function getNumberOfInstallments(): ?int
    {
        return $this->number_of_installments;
    }

    public function getOrderBillingStatus(): ?string
    {
        return $this->order_billing_status;
    }

    public function getOrderDate(): ?string
    {
        return $this->order_date;
    }

    public function getOrderDateTime(): ?string
    {
        return $this->order_date_time;
    }

    public function getOrderDetailsUrl(): ?string
    {
        return $this->order_details_url;
    }

    public function getOrderId(): ?string
    {
        return $this->order_id;
    }

    public function getOrderIsPaid(): ?string
    {
        return $this->order_is_paid;
    }

    public function getOrderTime(): ?string
    {
        return $this->order_time;
    }

    public function getOrderType(): ?string
    {
        return $this->order_type;
    }

    public function getOrderformId(): ?int
    {
        return $this->orderform_id;
    }

    public function getOtherAmounts(): ?float
    {
        return $this->other_amounts;
    }

    public function getOtherBillingIntervals(): ?string
    {
        return $this->other_billing_intervals;
    }

    public function getOtherVatAmounts(): ?float
    {
        return $this->other_vat_amounts;
    }

    public function getPayMethod(): ?string
    {
        return $this->pay_method;
    }

    public function getPaySequenceNo(): ?int
    {
        return $this->pay_sequence_no;
    }

    public function getPayplanId(): ?int
    {
        return $this->payplan_id;
    }

    public function getPaymentId(): ?string
    {
        return $this->payment_id;
    }

    public function getProductAmount(): ?float
    {
        return $this->product_amount;
    }

    public function getProductDeliveryType(): ?string
    {
        return $this->product_delivery_type;
    }

    public function getProductId(): ?int
    {
        return $this->product_id;
    }

    public function getProductId2(): ?int
    {
        return $this->product_id_2;
    }

    public function getProductId3(): ?int
    {
        return $this->product_id_3;
    }

    public function getProductId4(): ?int
    {
        return $this->product_id_4;
    }

    public function getProductId5(): ?int
    {
        return $this->product_id_5;
    }

    public function getProductId6(): ?int
    {
        return $this->product_id_6;
    }

    public function getProductId7(): ?int
    {
        return $this->product_id_7;
    }

    public function getProductId8(): ?int
    {
        return $this->product_id_8;
    }

    public function getProductId9(): ?int
    {
        return $this->product_id_9;
    }

    public function getProductId10(): ?int
    {
        return $this->product_id_10;
    }

    public function getProductId11(): ?int
    {
        return $this->product_id_11;
    }

    public function getProductId12(): ?int
    {
        return $this->product_id_12;
    }

    public function getProductId13(): ?int
    {
        return $this->product_id_13;
    }

    public function getProductId14(): ?int
    {
        return $this->product_id_14;
    }

    public function getProductId15(): ?int
    {
        return $this->product_id_15;
    }

    public function getProductId16(): ?int
    {
        return $this->product_id_16;
    }

    public function getProductId17(): ?int
    {
        return $this->product_id_17;
    }

    public function getProductId18(): ?int
    {
        return $this->product_id_18;
    }

    public function getProductId19(): ?int
    {
        return $this->product_id_19;
    }

    public function getProductId20(): ?int
    {
        return $this->product_id_20;
    }

    public function getProductId21(): ?int
    {
        return $this->product_id_21;
    }

    public function getProductId22(): ?int
    {
        return $this->product_id_22;
    }

    public function getProductId23(): ?int
    {
        return $this->product_id_23;
    }

    public function getProductId24(): ?int
    {
        return $this->product_id_24;
    }

    public function getProductId25(): ?int
    {
        return $this->product_id_25;
    }

    public function getProductId26(): ?int
    {
        return $this->product_id_26;
    }

    public function getProductId27(): ?int
    {
        return $this->product_id_27;
    }

    public function getProductId28(): ?int
    {
        return $this->product_id_28;
    }

    public function getProductId29(): ?int
    {
        return $this->product_id_29;
    }

    public function getProductId30(): ?int
    {
        return $this->product_id_30;
    }

    public function getProductId31(): ?int
    {
        return $this->product_id_31;
    }

    public function getProductId32(): ?int
    {
        return $this->product_id_32;
    }

    public function getProductId33(): ?int
    {
        return $this->product_id_33;
    }

    public function getProductId34(): ?int
    {
        return $this->product_id_34;
    }

    public function getProductId35(): ?int
    {
        return $this->product_id_35;
    }

    public function getProductId36(): ?int
    {
        return $this->product_id_36;
    }

    public function getProductId37(): ?int
    {
        return $this->product_id_37;
    }

    public function getProductId38(): ?int
    {
        return $this->product_id_38;
    }

    public function getProductId39(): ?int
    {
        return $this->product_id_39;
    }

    public function getProductId40(): ?int
    {
        return $this->product_id_40;
    }

    public function getProductId41(): ?int
    {
        return $this->product_id_41;
    }

    public function getProductId42(): ?int
    {
        return $this->product_id_42;
    }

    public function getProductId43(): ?int
    {
        return $this->product_id_43;
    }

    public function getProductId44(): ?int
    {
        return $this->product_id_44;
    }

    public function getProductId45(): ?int
    {
        return $this->product_id_45;
    }

    public function getProductId46(): ?int
    {
        return $this->product_id_46;
    }

    public function getProductId47(): ?int
    {
        return $this->product_id_47;
    }

    public function getProductId48(): ?int
    {
        return $this->product_id_48;
    }

    public function getProductId49(): ?int
    {
        return $this->product_id_49;
    }

    public function getProductId50(): ?int
    {
        return $this->product_id_50;
    }

    public function getProductId51(): ?int
    {
        return $this->product_id_51;
    }

    public function getProductId52(): ?int
    {
        return $this->product_id_52;
    }

    public function getProductId53(): ?int
    {
        return $this->product_id_53;
    }

    public function getProductId54(): ?int
    {
        return $this->product_id_54;
    }

    public function getProductId55(): ?int
    {
        return $this->product_id_55;
    }

    public function getProductId56(): ?int
    {
        return $this->product_id_56;
    }

    public function getProductId57(): ?int
    {
        return $this->product_id_57;
    }

    public function getProductId58(): ?int
    {
        return $this->product_id_58;
    }

    public function getProductId59(): ?int
    {
        return $this->product_id_59;
    }

    public function getProductId60(): ?int
    {
        return $this->product_id_60;
    }

    public function getProductId61(): ?int
    {
        return $this->product_id_61;
    }

    public function getProductId62(): ?int
    {
        return $this->product_id_62;
    }

    public function getProductId63(): ?int
    {
        return $this->product_id_63;
    }

    public function getProductId64(): ?int
    {
        return $this->product_id_64;
    }

    public function getProductId65(): ?int
    {
        return $this->product_id_65;
    }

    public function getProductId66(): ?int
    {
        return $this->product_id_66;
    }

    public function getProductId67(): ?int
    {
        return $this->product_id_67;
    }

    public function getProductId68(): ?int
    {
        return $this->product_id_68;
    }

    public function getProductId69(): ?int
    {
        return $this->product_id_69;
    }

    public function getProductId70(): ?int
    {
        return $this->product_id_70;
    }

    public function getProductId71(): ?int
    {
        return $this->product_id_71;
    }

    public function getProductId72(): ?int
    {
        return $this->product_id_72;
    }

    public function getProductId73(): ?int
    {
        return $this->product_id_73;
    }

    public function getProductId74(): ?int
    {
        return $this->product_id_74;
    }

    public function getProductId75(): ?int
    {
        return $this->product_id_75;
    }

    public function getProductId76(): ?int
    {
        return $this->product_id_76;
    }

    public function getProductId77(): ?int
    {
        return $this->product_id_77;
    }

    public function getProductId78(): ?int
    {
        return $this->product_id_78;
    }

    public function getProductId79(): ?int
    {
        return $this->product_id_79;
    }

    public function getProductId80(): ?int
    {
        return $this->product_id_80;
    }

    public function getProductId81(): ?int
    {
        return $this->product_id_81;
    }

    public function getProductId82(): ?int
    {
        return $this->product_id_82;
    }

    public function getProductId83(): ?int
    {
        return $this->product_id_83;
    }

    public function getProductId84(): ?int
    {
        return $this->product_id_84;
    }

    public function getProductId85(): ?int
    {
        return $this->product_id_85;
    }

    public function getProductId86(): ?int
    {
        return $this->product_id_86;
    }

    public function getProductId87(): ?int
    {
        return $this->product_id_87;
    }

    public function getProductId88(): ?int
    {
        return $this->product_id_88;
    }

    public function getProductId89(): ?int
    {
        return $this->product_id_89;
    }

    public function getProductId90(): ?int
    {
        return $this->product_id_90;
    }

    public function getProductId91(): ?int
    {
        return $this->product_id_91;
    }

    public function getProductId92(): ?int
    {
        return $this->product_id_92;
    }

    public function getProductId93(): ?int
    {
        return $this->product_id_93;
    }

    public function getProductId94(): ?int
    {
        return $this->product_id_94;
    }

    public function getProductId95(): ?int
    {
        return $this->product_id_95;
    }

    public function getProductId96(): ?int
    {
        return $this->product_id_96;
    }

    public function getProductId97(): ?int
    {
        return $this->product_id_97;
    }

    public function getProductId98(): ?int
    {
        return $this->product_id_98;
    }

    public function getProductId99(): ?int
    {
        return $this->product_id_99;
    }

    public function getProductId100(): ?int
    {
        return $this->product_id_100;
    }

    public function getProductIds(): ?string
    {
        return $this->product_ids;
    }

    public function getProductLanguage(): ?string
    {
        return $this->product_language;
    }

    public function getProductName(): ?string
    {
        return $this->product_name;
    }

    public function getProductNettoAmount(): ?float
    {
        return $this->product_netto_amount;
    }

    public function getProductShippingAmount(): ?float
    {
        return $this->product_shipping_amount;
    }

    public function getProductTxnAmount(): ?float
    {
        return $this->product_txn_amount;
    }

    public function getProductTxnNettoAmount(): ?float
    {
        return $this->product_txn_netto_amount;
    }

    public function getProductTxnShipping(): ?float
    {
        return $this->product_txn_shipping;
    }

    public function getProductTxnVatAmount(): ?float
    {
        return $this->product_txn_vat_amount;
    }

    public function getProductVatAmount(): ?float
    {
        return $this->product_vat_amount;
    }

    public function getQuantity(): ?int
    {
        return $this->quantity;
    }

    public function getRebillStopNotedAt(): ?string
    {
        return $this->rebill_stop_noted_at;
    }

    public function getRebillingStopUrl(): ?string
    {
        return $this->rebilling_stop_url;
    }

    public function getReceiptUrl(): ?string
    {
        return $this->receipt_url;
    }

    public function getReferringAffiliateName(): ?string
    {
        return $this->referring_affiliate_name;
    }

    public function getRefundDays(): ?string
    {
        return $this->refund_days;
    }

    public function getRenewUrl(): ?string
    {
        return $this->renew_url;
    }

    public function getRequestRefundUrl(): ?string
    {
        return $this->request_refund_url;
    }

    public function getSalesteamId(): ?int
    {
        return $this->salesteam_id;
    }

    public function getSalesteamName(): ?string
    {
        return $this->salesteam_name;
    }

    public function getShaSign(): ?string
    {
        return $this->sha_sign;
    }

    public function getSupportUrl(): ?string
    {
        return $this->support_url;
    }

    public function getTag1(): ?string
    {
        return $this->tag1;
    }

    public function getTag2(): ?string
    {
        return $this->tag2;
    }

    public function getTag3(): ?string
    {
        return $this->tag3;
    }

    public function getTag4(): ?string
    {
        return $this->tag4;
    }

    public function getTag5(): ?string
    {
        return $this->tag5;
    }

    public function getTag6(): ?string
    {
        return $this->tag6;
    }

    public function getTag7(): ?string
    {
        return $this->tag7;
    }

    public function getTag8(): ?string
    {
        return $this->tag8;
    }

    public function getTag9(): ?string
    {
        return $this->tag9;
    }

    public function getTag10(): ?string
    {
        return $this->tag10;
    }

    public function getTag11(): ?string
    {
        return $this->tag11;
    }

    public function getTag12(): ?string
    {
        return $this->tag12;
    }

    public function getTag13(): ?string
    {
        return $this->tag13;
    }

    public function getTag14(): ?string
    {
        return $this->tag14;
    }

    public function getTag15(): ?string
    {
        return $this->tag15;
    }

    public function getTag16(): ?string
    {
        return $this->tag16;
    }

    public function getTag17(): ?string
    {
        return $this->tag17;
    }

    public function getTag18(): ?string
    {
        return $this->tag18;
    }

    public function getTag19(): ?string
    {
        return $this->tag19;
    }

    public function getTag20(): ?string
    {
        return $this->tag20;
    }

    public function getTag21(): ?string
    {
        return $this->tag21;
    }

    public function getTag22(): ?string
    {
        return $this->tag22;
    }

    public function getTag23(): ?string
    {
        return $this->tag23;
    }

    public function getTag24(): ?string
    {
        return $this->tag24;
    }

    public function getTag25(): ?string
    {
        return $this->tag25;
    }

    public function getTag26(): ?string
    {
        return $this->tag26;
    }

    public function getTag27(): ?string
    {
        return $this->tag27;
    }

    public function getTag28(): ?string
    {
        return $this->tag28;
    }

    public function getTag29(): ?string
    {
        return $this->tag29;
    }

    public function getTag30(): ?string
    {
        return $this->tag30;
    }

    public function getTag31(): ?string
    {
        return $this->tag31;
    }

    public function getTag32(): ?string
    {
        return $this->tag32;
    }

    public function getTag33(): ?string
    {
        return $this->tag33;
    }

    public function getTag34(): ?string
    {
        return $this->tag34;
    }

    public function getTag35(): ?string
    {
        return $this->tag35;
    }

    public function getTag36(): ?string
    {
        return $this->tag36;
    }

    public function getTag37(): ?string
    {
        return $this->tag37;
    }

    public function getTag38(): ?string
    {
        return $this->tag38;
    }

    public function getTag39(): ?string
    {
        return $this->tag39;
    }

    public function getTag40(): ?string
    {
        return $this->tag40;
    }

    public function getTag41(): ?string
    {
        return $this->tag41;
    }

    public function getTag42(): ?string
    {
        return $this->tag42;
    }

    public function getTag43(): ?string
    {
        return $this->tag43;
    }

    public function getTag44(): ?string
    {
        return $this->tag44;
    }

    public function getTag45(): ?string
    {
        return $this->tag45;
    }

    public function getTag46(): ?string
    {
        return $this->tag46;
    }

    public function getTag47(): ?string
    {
        return $this->tag47;
    }

    public function getTag48(): ?string
    {
        return $this->tag48;
    }

    public function getTag49(): ?string
    {
        return $this->tag49;
    }

    public function getTag50(): ?string
    {
        return $this->tag50;
    }

    public function getTag51(): ?string
    {
        return $this->tag51;
    }

    public function getTag52(): ?string
    {
        return $this->tag52;
    }

    public function getTag53(): ?string
    {
        return $this->tag53;
    }

    public function getTag54(): ?string
    {
        return $this->tag54;
    }

    public function getTag55(): ?string
    {
        return $this->tag55;
    }

    public function getTag56(): ?string
    {
        return $this->tag56;
    }

    public function getTag57(): ?string
    {
        return $this->tag57;
    }

    public function getTag58(): ?string
    {
        return $this->tag58;
    }

    public function getTag59(): ?string
    {
        return $this->tag59;
    }

    public function getTag60(): ?string
    {
        return $this->tag60;
    }

    public function getTag61(): ?string
    {
        return $this->tag61;
    }

    public function getTag62(): ?string
    {
        return $this->tag62;
    }

    public function getTag63(): ?string
    {
        return $this->tag63;
    }

    public function getTag64(): ?string
    {
        return $this->tag64;
    }

    public function getTag65(): ?string
    {
        return $this->tag65;
    }

    public function getTag66(): ?string
    {
        return $this->tag66;
    }

    public function getTag67(): ?string
    {
        return $this->tag67;
    }

    public function getTag68(): ?string
    {
        return $this->tag68;
    }

    public function getTag69(): ?string
    {
        return $this->tag69;
    }

    public function getTag70(): ?string
    {
        return $this->tag70;
    }

    public function getTag71(): ?string
    {
        return $this->tag71;
    }

    public function getTag72(): ?string
    {
        return $this->tag72;
    }

    public function getTag73(): ?string
    {
        return $this->tag73;
    }

    public function getTag74(): ?string
    {
        return $this->tag74;
    }

    public function getTag75(): ?string
    {
        return $this->tag75;
    }

    public function getTag76(): ?string
    {
        return $this->tag76;
    }

    public function getTag77(): ?string
    {
        return $this->tag77;
    }

    public function getTag78(): ?string
    {
        return $this->tag78;
    }

    public function getTag79(): ?string
    {
        return $this->tag79;
    }

    public function getTag80(): ?string
    {
        return $this->tag80;
    }

    public function getTag81(): ?string
    {
        return $this->tag81;
    }

    public function getTag82(): ?string
    {
        return $this->tag82;
    }

    public function getTag83(): ?string
    {
        return $this->tag83;
    }

    public function getTag84(): ?string
    {
        return $this->tag84;
    }

    public function getTag85(): ?string
    {
        return $this->tag85;
    }

    public function getTag86(): ?string
    {
        return $this->tag86;
    }

    public function getTag87(): ?string
    {
        return $this->tag87;
    }

    public function getTag88(): ?string
    {
        return $this->tag88;
    }

    public function getTag89(): ?string
    {
        return $this->tag89;
    }

    public function getTag90(): ?string
    {
        return $this->tag90;
    }

    public function getTag91(): ?string
    {
        return $this->tag91;
    }

    public function getTag92(): ?string
    {
        return $this->tag92;
    }

    public function getTag93(): ?string
    {
        return $this->tag93;
    }

    public function getTag94(): ?string
    {
        return $this->tag94;
    }

    public function getTag95(): ?string
    {
        return $this->tag95;
    }

    public function getTag96(): ?string
    {
        return $this->tag96;
    }

    public function getTag97(): ?string
    {
        return $this->tag97;
    }

    public function getTag98(): ?string
    {
        return $this->tag98;
    }

    public function getTag99(): ?string
    {
        return $this->tag99;
    }

    public function getTag100(): ?string
    {
        return $this->tag100;
    }

    public function getTags(): ?string
    {
        return $this->tags;
    }

    public function getTransactionAmount(): ?float
    {
        return $this->transaction_amount;
    }

    public function getTransactionCurrency(): ?string
    {
        return $this->transaction_currency;
    }

    public function getTransactionId(): ?int
    {
        return $this->transaction_id;
    }

    public function getTransactionDate(): ?string
    {
        return $this->transaction_date;
    }

    public function getTransactionProcessedAt(): ?string
    {
        return $this->transaction_processed_at;
    }

    public function getTransactionType(): ?string
    {
        return $this->transaction_type;
    }

    public function getTrackingkey(): ?string
    {
        return $this->trackingkey;
    }

    public function getUpgradeKey(): ?string
    {
        return $this->upgrade_key;
    }

    public function getUpgradeType(): ?string
    {
        return $this->upgrade_type;
    }

    public function getUpgradedAddressFirstName(): ?string
    {
        return $this->upgraded_address_first_name;
    }

    public function getUpgradedAddressLastName(): ?string
    {
        return $this->upgraded_address_last_name;
    }

    public function getUpgradedBuyerId(): ?int
    {
        return $this->upgraded_buyer_id;
    }

    public function getUpgradedEmail(): ?string
    {
        return $this->upgraded_email;
    }

    public function getUpgradedOrderDate(): ?string
    {
        return $this->upgraded_order_date;
    }

    public function getUpgradedOrderDateTime(): ?string
    {
        return $this->upgraded_order_date_time;
    }

    public function getUpgradedOrderId(): ?string
    {
        return $this->upgraded_order_id;
    }

    public function getUpgradedOrderPaidUntil(): ?string
    {
        return $this->upgraded_order_paid_until;
    }

    public function getUpgradedOrderTime(): ?string
    {
        return $this->upgraded_order_time;
    }

    public function getUpgradedProductId(): ?int
    {
        return $this->upgraded_product_id;
    }

    public function getUpgradedProductId2(): ?int
    {
        return $this->upgraded_product_id_2;
    }

    public function getUpgradedProductId3(): ?int
    {
        return $this->upgraded_product_id_3;
    }

    public function getUpgradedProductId4(): ?int
    {
        return $this->upgraded_product_id_4;
    }

    public function getUpgradedProductId5(): ?int
    {
        return $this->upgraded_product_id_5;
    }

    public function getUpgradedProductId6(): ?int
    {
        return $this->upgraded_product_id_6;
    }

    public function getUpgradedProductId7(): ?int
    {
        return $this->upgraded_product_id_7;
    }

    public function getUpgradedProductId8(): ?int
    {
        return $this->upgraded_product_id_8;
    }

    public function getUpgradedProductId9(): ?int
    {
        return $this->upgraded_product_id_9;
    }

    public function getUpgradedProductId10(): ?int
    {
        return $this->upgraded_product_id_10;
    }

    public function getUpgradedProductId11(): ?int
    {
        return $this->upgraded_product_id_11;
    }

    public function getUpgradedProductId12(): ?int
    {
        return $this->upgraded_product_id_12;
    }

    public function getUpgradedProductId13(): ?int
    {
        return $this->upgraded_product_id_13;
    }

    public function getUpgradedProductId14(): ?int
    {
        return $this->upgraded_product_id_14;
    }

    public function getUpgradedProductId15(): ?int
    {
        return $this->upgraded_product_id_15;
    }

    public function getUpgradedProductId16(): ?int
    {
        return $this->upgraded_product_id_16;
    }

    public function getUpgradedProductId17(): ?int
    {
        return $this->upgraded_product_id_17;
    }

    public function getUpgradedProductId18(): ?int
    {
        return $this->upgraded_product_id_18;
    }

    public function getUpgradedProductId19(): ?int
    {
        return $this->upgraded_product_id_19;
    }

    public function getUpgradedProductId20(): ?int
    {
        return $this->upgraded_product_id_20;
    }

    public function getUpgradedProductId21(): ?int
    {
        return $this->upgraded_product_id_21;
    }

    public function getUpgradedProductId22(): ?int
    {
        return $this->upgraded_product_id_22;
    }

    public function getUpgradedProductId23(): ?int
    {
        return $this->upgraded_product_id_23;
    }

    public function getUpgradedProductId24(): ?int
    {
        return $this->upgraded_product_id_24;
    }

    public function getUpgradedProductId25(): ?int
    {
        return $this->upgraded_product_id_25;
    }

    public function getUpgradedProductId26(): ?int
    {
        return $this->upgraded_product_id_26;
    }

    public function getUpgradedProductId27(): ?int
    {
        return $this->upgraded_product_id_27;
    }

    public function getUpgradedProductId28(): ?int
    {
        return $this->upgraded_product_id_28;
    }

    public function getUpgradedProductId29(): ?int
    {
        return $this->upgraded_product_id_29;
    }

    public function getUpgradedProductId30(): ?int
    {
        return $this->upgraded_product_id_30;
    }

    public function getUpgradedProductId31(): ?int
    {
        return $this->upgraded_product_id_31;
    }

    public function getUpgradedProductId32(): ?int
    {
        return $this->upgraded_product_id_32;
    }

    public function getUpgradedProductId33(): ?int
    {
        return $this->upgraded_product_id_33;
    }

    public function getUpgradedProductId34(): ?int
    {
        return $this->upgraded_product_id_34;
    }

    public function getUpgradedProductId35(): ?int
    {
        return $this->upgraded_product_id_35;
    }

    public function getUpgradedProductId36(): ?int
    {
        return $this->upgraded_product_id_36;
    }

    public function getUpgradedProductId37(): ?int
    {
        return $this->upgraded_product_id_37;
    }

    public function getUpgradedProductId38(): ?int
    {
        return $this->upgraded_product_id_38;
    }

    public function getUpgradedProductId39(): ?int
    {
        return $this->upgraded_product_id_39;
    }

    public function getUpgradedProductId40(): ?int
    {
        return $this->upgraded_product_id_40;
    }

    public function getUpgradedProductId41(): ?int
    {
        return $this->upgraded_product_id_41;
    }

    public function getUpgradedProductId42(): ?int
    {
        return $this->upgraded_product_id_42;
    }

    public function getUpgradedProductId43(): ?int
    {
        return $this->upgraded_product_id_43;
    }

    public function getUpgradedProductId44(): ?int
    {
        return $this->upgraded_product_id_44;
    }

    public function getUpgradedProductId45(): ?int
    {
        return $this->upgraded_product_id_45;
    }

    public function getUpgradedProductId46(): ?int
    {
        return $this->upgraded_product_id_46;
    }

    public function getUpgradedProductId47(): ?int
    {
        return $this->upgraded_product_id_47;
    }

    public function getUpgradedProductId48(): ?int
    {
        return $this->upgraded_product_id_48;
    }

    public function getUpgradedProductId49(): ?int
    {
        return $this->upgraded_product_id_49;
    }

    public function getUpgradedProductId50(): ?int
    {
        return $this->upgraded_product_id_50;
    }

    public function getUpgradedProductId51(): ?int
    {
        return $this->upgraded_product_id_51;
    }

    public function getUpgradedProductId52(): ?int
    {
        return $this->upgraded_product_id_52;
    }

    public function getUpgradedProductId53(): ?int
    {
        return $this->upgraded_product_id_53;
    }

    public function getUpgradedProductId54(): ?int
    {
        return $this->upgraded_product_id_54;
    }

    public function getUpgradedProductId55(): ?int
    {
        return $this->upgraded_product_id_55;
    }

    public function getUpgradedProductId56(): ?int
    {
        return $this->upgraded_product_id_56;
    }

    public function getUpgradedProductId57(): ?int
    {
        return $this->upgraded_product_id_57;
    }

    public function getUpgradedProductId58(): ?int
    {
        return $this->upgraded_product_id_58;
    }

    public function getUpgradedProductId59(): ?int
    {
        return $this->upgraded_product_id_59;
    }

    public function getUpgradedProductId60(): ?int
    {
        return $this->upgraded_product_id_60;
    }

    public function getUpgradedProductId61(): ?int
    {
        return $this->upgraded_product_id_61;
    }

    public function getUpgradedProductId62(): ?int
    {
        return $this->upgraded_product_id_62;
    }

    public function getUpgradedProductId63(): ?int
    {
        return $this->upgraded_product_id_63;
    }

    public function getUpgradedProductId64(): ?int
    {
        return $this->upgraded_product_id_64;
    }

    public function getUpgradedProductId65(): ?int
    {
        return $this->upgraded_product_id_65;
    }

    public function getUpgradedProductId66(): ?int
    {
        return $this->upgraded_product_id_66;
    }

    public function getUpgradedProductId67(): ?int
    {
        return $this->upgraded_product_id_67;
    }

    public function getUpgradedProductId68(): ?int
    {
        return $this->upgraded_product_id_68;
    }

    public function getUpgradedProductId69(): ?int
    {
        return $this->upgraded_product_id_69;
    }

    public function getUpgradedProductId70(): ?int
    {
        return $this->upgraded_product_id_70;
    }

    public function getUpgradedProductId71(): ?int
    {
        return $this->upgraded_product_id_71;
    }

    public function getUpgradedProductId72(): ?int
    {
        return $this->upgraded_product_id_72;
    }

    public function getUpgradedProductId73(): ?int
    {
        return $this->upgraded_product_id_73;
    }

    public function getUpgradedProductId74(): ?int
    {
        return $this->upgraded_product_id_74;
    }

    public function getUpgradedProductId75(): ?int
    {
        return $this->upgraded_product_id_75;
    }

    public function getUpgradedProductId76(): ?int
    {
        return $this->upgraded_product_id_76;
    }

    public function getUpgradedProductId77(): ?int
    {
        return $this->upgraded_product_id_77;
    }

    public function getUpgradedProductId78(): ?int
    {
        return $this->upgraded_product_id_78;
    }

    public function getUpgradedProductId79(): ?int
    {
        return $this->upgraded_product_id_79;
    }

    public function getUpgradedProductId80(): ?int
    {
        return $this->upgraded_product_id_80;
    }

    public function getUpgradedProductId81(): ?int
    {
        return $this->upgraded_product_id_81;
    }

    public function getUpgradedProductId82(): ?int
    {
        return $this->upgraded_product_id_82;
    }

    public function getUpgradedProductId83(): ?int
    {
        return $this->upgraded_product_id_83;
    }

    public function getUpgradedProductId84(): ?int
    {
        return $this->upgraded_product_id_84;
    }

    public function getUpgradedProductId85(): ?int
    {
        return $this->upgraded_product_id_85;
    }

    public function getUpgradedProductId86(): ?int
    {
        return $this->upgraded_product_id_86;
    }

    public function getUpgradedProductId87(): ?int
    {
        return $this->upgraded_product_id_87;
    }

    public function getUpgradedProductId88(): ?int
    {
        return $this->upgraded_product_id_88;
    }

    public function getUpgradedProductId89(): ?int
    {
        return $this->upgraded_product_id_89;
    }

    public function getUpgradedProductId90(): ?int
    {
        return $this->upgraded_product_id_90;
    }

    public function getUpgradedProductId91(): ?int
    {
        return $this->upgraded_product_id_91;
    }

    public function getUpgradedProductId92(): ?int
    {
        return $this->upgraded_product_id_92;
    }

    public function getUpgradedProductId93(): ?int
    {
        return $this->upgraded_product_id_93;
    }

    public function getUpgradedProductId94(): ?int
    {
        return $this->upgraded_product_id_94;
    }

    public function getUpgradedProductId95(): ?int
    {
        return $this->upgraded_product_id_95;
    }

    public function getUpgradedProductId96(): ?int
    {
        return $this->upgraded_product_id_96;
    }

    public function getUpgradedProductId97(): ?int
    {
        return $this->upgraded_product_id_97;
    }

    public function getUpgradedProductId98(): ?int
    {
        return $this->upgraded_product_id_98;
    }

    public function getUpgradedProductId99(): ?int
    {
        return $this->upgraded_product_id_99;
    }

    public function getUpgradedProductId100(): ?int
    {
        return $this->upgraded_product_id_100;
    }

    public function getUpgradedProductName(): ?string
    {
        return $this->upgraded_product_name;
    }

    public function getUpgradedProductName2(): ?string
    {
        return $this->upgraded_product_name_2;
    }

    public function getUpgradedProductName3(): ?string
    {
        return $this->upgraded_product_name_3;
    }

    public function getVariantId(): ?string
    {
        return $this->variant_id;
    }

    public function getVariantName(): ?string
    {
        return $this->variant_name;
    }

    public function getVatRate(): ?float
    {
        return $this->vat_rate;
    }

    public function getVoucherCode(): ?string
    {
        return $this->voucher_code;
    }

    public function getUsedCouponCode(): ?string
    {
        return $this->used_coupon_code;
    }

    public function getUsedCouponId(): ?int
    {
        return $this->used_coupon_id;
    }
}
