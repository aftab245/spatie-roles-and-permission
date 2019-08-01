<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Http\Request;

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
    // protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }


    public function redirectTo()
    {
        if(auth()->user()->hasRole('Admin'))
        {
            return '/admin';
        } 
        else
        {
            return '/posts';
        }     
    }


    public function redirectToProvider()
    {
        return Socialite::driver('facebook')
        // ->scopes(['email'])
        // ->fields(['first_name', 'last_name', 'email',])->scopes(['email',])
        ->redirect();
    }

    /**
     * Obtain the user information from facebook.
     *
     * @return \Illuminate\Http\Response
     */
    public function handleProviderCallback()
    {
        try{
            $user = Socialite::driver('facebook')->user();
        } catch (\Exception $e) {
            return redirect('/login')->with('status', 'Something went wrong or You have rejected the app!');
        }
        $userSocialite = Socialite::driver('facebook')
        ->setHttpClient(new \GuzzleHttp\Client(['verify' => false]))
        ->user();
        $userSocialite->name;
        // dd($userSocialite);
      //  return [$userSocialite->name,$userSocialite->email,$userSocialite->token];
        // $user = new User();
        // $user->name = $userSocialite->name;
        // $user->email = $userSocialite->email;
        // $user->save;


    }



    public function Provider()
    {
        return Socialite::driver('google')->redirect();        
    }

    /**
     * Obtain the user information from gooogle.
     *
     * @return \Illuminate\Http\Response
     */
    public function Callback()
    {
        $user = Socialite::driver('google')->setHttpClient(new \GuzzleHttp\Client(['verify' => false]))->user();
        dd($user);
        return [$user->name,$user->email,$user->token];
    }

    public function twitterProvider()
    {
        return Socialite::driver('twitter')->redirect();
    }

    /**
     * Obtain the user information from gooogle.
     *
     * @return \Illuminate\Http\Response
     */
    public function twitterCallback()
    {
        $user = Socialite::driver('twitter')->setHttpClient(new \GuzzleHttp\Client(['verify' => false]))->user();
        return [$user->name,$user->email,$user->token];
    }
    

}