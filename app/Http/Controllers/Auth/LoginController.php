<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

use Hash;
use Auth;
use Socialite;
use App\User;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function redirectToProvider()
    {
        return Socialite::driver('github')->redirect();
    }
    
    public function handleProviderCallback()
    {
        $socialUser = Socialite::driver('github')->stateless()->user();
        $user = User::where([ 'email' => $socialUser->getEmail() ])->first();
    
        if ($user) {
            Auth::login($user);
            return redirect('/home');
        } else {
            $user = User::create([
                'name' => $socialUser->getNickname(),
                'email' => $socialUser->getEmail(),
                'password' => Hash::make($socialUser->getNickname()),  // 例としての記述なので、マネしないように
            ]);
            Auth::login($user);
            return redirect('/top');
        }
      }
}
