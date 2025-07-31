<?php

declare(strict_types=1);

namespace GoSuccess\Digistore24IPN\Enum;

/**
 * Enum representing various events in the Digistore24 IPN system.
 *
 * Each case corresponds to a specific event that can occur during
 * transactions, such as payments, refunds, chargebacks, and more.
 */
enum Event: string
{
    /**
     * The buyer makes a successful payment.
     */
    case ON_PAYMENT = 'on_payment';

    /**
     * The support team of the vendor or Digistore24 has
     * initiated a refund, which has been successfully processed.
     */
    case ON_REFUND = 'on_refund';

    /**
     * The credit card company processed a chargeback.
     */
    case ON_CHARGEBACK = 'on_chargeback';

    /**
     * For a subscription or installment payment, a payment is missing
     * (e.g. due to insufficient funds or expired payment method).
     * Use this to temporarily suspend access to your product or
     * membership until a successful payment is made.
     *
     * IMPORTANT: Do not use this event for cancellations or refunds –
     * use last_paid_day instead. You can find more details here.
     * Please note that an on_payment event may occur if the buyer
     * succeeds in payment after the on_payment_missed event. In that
     * case, access should be granted again.
     * After this event is triggered, Digistore24 will retry the charge
     * multiple times and notify the customer via email. If all retries
     * fail, the subscription will be automatically cancelled, and
     * last_paid_day will be triggered.
     */
    case ON_PAYMENT_MISSED = 'on_payment_missed';

    /**
     * The payment was rejected. The IPN event is sent after the last
     * payment attempt. By default, rejected payments are not selected
     * in the IPN configuration.
     */
    case PAYMENT_DENIAL = 'payment_denial';

    /**
     * This event is sent immediately when the support clicks the
     * "stop rebilling" button in the order details. When the last paid
     * billing period has ended, last_paid_day is sent.
     */
    case ON_REBILL_CANCELLED = 'on_rebill_cancelled';

    /**
     * The buyer has requested to continue the rebilling payments. This
     * event is sent, when the support clicks the "restart rebilling"
     * button in the order details.
     */
    case ON_REBILL_RESUMED = 'on_rebill_resumed';

    /**
     * The last paid billing period has ended, usually due to a
     * cancellation or refund.
     * Use this event to permanently revoke access, as no further
     * payments will be collected.
     * It is typically sent early in the morning after the final access
     * day.
     * This event is also triggered automatically if all retry attempts
     * after an on_payment_missed event fail.
     */
    case LAST_PAID_DAY = 'last_paid_day';

    /**
     * When an affiliate wants to promote your product and the
     * affiliation is accepted, then an IPN-Call with this event will be
     * sent.
     */
    case ON_AFFILIATION = 'on_affiliation';

    /**
     * For created e-tickets. This may also take place after the order
     * has been placed, as the buyer may not enter the participant data
     * until later. The IPN message for an e-ticket can also be sent
     * twice if, for example, a name is entered or corrected later.
     * Therefore, please use eticket_id to check whether the ticket is
     * already in your database.
     */
    case ETICKET = 'eticket';

    /**
     * For completed additional input fields.
     */
    case CUSTOM_FORM = 'custom_form';

    /**
     * Our server sends this event to test the connection to your
     * server, e.g. if you hit the "Test connection" button in the
     * vendor’s IPN settings section. The response should always be
     * "OK".
     * If the test fails, check again the above points of this
     * integration guide and if the server is reachable with the script.
     * @link https://dev.digistore24.com/hc/en-us/articles/32480217565969-Quick-Integration-Guide
     */
    case CONNECTION_TEST = 'connection_test';
}
