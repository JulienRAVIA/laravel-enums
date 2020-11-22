<?php

namespace Nasyrov\Laravel\Enums\Enum;

use Nasyrov\Laravel\Enums\Enum;

/**
 * @method static User Administrator
 * @method static User Moderator
 */
class User extends Enum
{
    public const Administrator = 'user';
    public const Moderator = 'moderator';
    public const SuperModerator = 'super_moderator';
}
