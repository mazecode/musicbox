<?php

namespace App\Pivots;

use Illuminate\Database\Eloquent\Relations\Pivot;

/**
 * Class SocialUser
 * @package App\Pivots
 */
class SocialUser extends Pivot
{
    protected $table = 'social_users';
}
