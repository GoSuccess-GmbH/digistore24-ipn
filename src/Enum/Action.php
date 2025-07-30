<?php

declare(strict_types=1);

namespace GoSuccess\Digistore24IPN\Enum;

/**
 * Enum representing various actions in the Digistore24 IPN system.
 *
 * This enum defines the actions that can be performed, such as creating,
 * updating, using, canceling use, revoking, and canceling revocation.
 */
enum Action: string
{
    /**
     * Action to create a resource.
     */
    case CREATE = 'create';

    /**
     * Action to update a resource.
     */
    case UPDATE = 'update';

    /**
     * Action to use a resource.
     */
    case USE = 'use';

    /**
     * Action to cancel the use of a resource.
     */
    case CANCEL_USE = 'cancel_use';

    /**
     * Action to revoke a resource.
     */
    case REVOKE = 'revoke';

    /**
     * Action to cancel the revocation of a resource.
     */
    case CANCEL_REVOKE = 'cancel_revoke';
}
