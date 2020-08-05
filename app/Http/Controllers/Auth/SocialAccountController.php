<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Socialite;

class SocialAccountController extends Controller
{
    public function redirectToProvider($provider)
    {
        try {
            return Socialite::driver($provider)->scopes(['email', 'profile', 'openid'])->redirect();
        } catch (Exception $e) {
            return abort(500);
        }
    }

    public function handleProviderCallback($provider)
    {
        try {
            $user = Socialite::driver($provider)->stateless()->user();
        } catch (Exception $e) {
            return abort(500);
        }

        $databaseUser = User::where('email', $user->getEmail())->first();

        if (explode("@", $user->getEmail())[1] === 'masp.org.br' && !$databaseUser) {
            $databaseUser = $this->create($user);
        }

        return $databaseUser ? $this->login($databaseUser, $user) : abort(403);
    }

    public function login($localUser, $googleUser)
    {
        auth()->login($localUser, true);
        $localUser->update(['avatar' => $googleUser->getAvatar()]);

        session()->put('google_user', $googleUser);
        return redirect('/');
    }

    public function create($user)
    {
        return User::create(
            [
                'nome' => $user->getName(),
                'login' => explode("@", $user->getEmail())[0],
                'senha' => '',
                'status' => 1,
                'data_criacao' => Carbon::now(),
                'email' => $user->getEmail(),
                'avatar' => $user->getAvatar()
            ]
        );
    }
}
