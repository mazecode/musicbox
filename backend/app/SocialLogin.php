<?php

namespace App;

use App\Pivots\SocialUser;
use Illuminate\Database\Eloquent\Model;

/**
 * Class SocialLogin
 * @package App
 */
class SocialLogin extends Model
{
    protected $table = 'social_logins';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'avatar', 'provider_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The users that belong to the SocialLogins.
     */
    public function users()
    {
        return $this->belongsToMany(User::class, 'social_users', 'social_login_id', 'user_id')->using(SocialUser::class);
    }
}
