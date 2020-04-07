<?php

namespace App\Http\Controllers\Api\V1;
// use App\Helpers\Auth\Auth;
// use App\Helpers\Frontend\Auth\Socialite;
use App\Http\Controllers\Controller;
use App\Http\Utilities\NotificationIos;
use App\Http\Utilities\PushNotification;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Socialite;
use Illuminate\Support\Facades\Auth;
use App\Models\Access\SocialLogin\SocialLogin;
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
        $data = User::findOrCreateUser($user, $provider);
        Auth::login($data['userInfo'], true);
        return response()->json([
           'user'       => $data['userInfo'],
           'token'      => $data['socialInfo']->token,
           'message'    => trans('api.messages.login.success'),
           'avatar'     => $data['socialInfo']->avatar
           ]);
    }
   
}
