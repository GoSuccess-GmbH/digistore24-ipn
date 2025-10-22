<?php

declare(strict_types=1);

namespace GoSuccess\Digistore24\Ipn\Enum;

/**
 * Enum representing various product delivery types.
 *
 * This enum defines the delivery methods available for products,
 * such as digital downloads, physical shipping, and subscriptions.
 */
enum ProductDeliveryType: string
{
    /**
     * Delivery type for digital products.
     */
    case DIGITAL = 'digital';

    /**
     * Delivery type for physical products.
     */
    case SHIPPING = 'shipping';
}
