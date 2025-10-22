<?php

declare(strict_types=1);

namespace GoSuccess\Digistore24\Ipn\Enum;

/**
 * Enum representing various upgrade types.
 *
 * This enum defines the different types of upgrades available for products,
 * such as one-time upgrades, recurring upgrades, and trial upgrades.
 */
enum UpgradeType: string
{
    /**
     * Upgrade type for one-time upgrades.
     */
    case UPGRADE = 'upgrade';

    /**
     * Upgrade type for downgrades.
     */
    case DOWNGRADE = 'downgrade';

    /**
     * Upgrade type for special offers.
     */
    case SPECIAL_OFFER = 'special_offer';

    /**
     * Upgrade type for switching plans.
     */
    case SWITCH_PLAN = 'switch_plan';

    /**
     * Upgrade type for package changes.
     */
    case PACKAGE_CHANGE = 'package_change';
}
