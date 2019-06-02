<?php

namespace App\Http\Controllers;

use App\SocialLogin;
use App\User;
use Auth;
use Socialite;

/**
 * Class SocialController
 * @package App\Http\Controllers
 */
class SocialController extends Controller
{
    public function __construct()
    {
    }

    public function login(string $driver)
    {
        return Socialite::driver($driver)->redirect();
    }

    /**
     * @param string $driver
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function callback(string $driver)
    {
        $socialite = Socialite::with($driver)->user();

        $socialLogin = SocialLogin::where('driver', $driver)->first();
        $user = $socialLogin->users()->where('social_provider_id', $socialite->getId())->first();

        if (!$user) {
            $user = User::where('email', $socialite->getEmail())->first();
            $user->socialLogin()->attach($socialLogin->id, ['social_provider_id' => $socialite->getId()]);
        }

        if (!$user) {
            $user = new User();
            $user->name = $socialite->getName();
            $user->username = $socialite->getNickname() ?: explode(' ', $socialite->getName())[0];
            $user->email = $socialite->getEmail();
            $user->avatar = $socialite->getAvatar();
            $user->password = \Hash::make($socialite->getNickname());
            $user->save();

            $user->socialLogin()->attach($socialLogin->id, ['social_provider_id' => $socialite->getId()]);
        }

        return $this->authAndRedirect($user);
    }

    /**
     * @param User $user
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function authAndRedirect(User $user)
    {
        Auth::login($user);

        return redirect('/home#');
    }
}
