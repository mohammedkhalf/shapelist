<?php

namespace App\Http\Controllers\Api\V1;
use App\Http\Utilities\NotificationIos;
use App\Http\Utilities\PushNotification;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Socialite;
use Illuminate\Support\Facades\Auth;
use App\Models\Access\User\User;


/**
 * Class SocialLoginController.
 */
class SocialLoginController extends APIController
{
    use AuthenticatesUsers;

    /**
     * @var \App\Http\Utilities\PushNotification
     */
    protected $notification;

    /**
     * @param NotificationIos $notification
     */
    public function __construct(PushNotification $notification)
    {
        $this->notification = $notification;

    }
    //========================= social login =============================
    public function redirectToProvider($provider)
    {
        return Socialite::driver($provider)->redirect();
    }
    public function handleProviderCallback($provider)
    {
        $user = Socialite::driver($provider)->stateless()->user();
        if(User::where('email','=',$user->email)->first())
        {
             return response()->json(['message'=>"this email already exist"]);
        }
        $userInfo = User::CreateUser($user, $provider);
        Auth::login($userInfo,true);
        return response()->json([
           'user'       => $userInfo,
           'token'      =>  $userInfo->socialLoginTable->token,
           'message'    => trans('api.messages.login.success'),
          'avatar'     => $userInfo->socialLoginTable->avatar
           ]);
    }
   
}
