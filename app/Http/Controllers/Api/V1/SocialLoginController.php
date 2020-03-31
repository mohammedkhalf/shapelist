<?php

namespace App\Http\Controllers\Api\V1;

use App\Events\Frontend\Auth\UserLoggedIn;
use App\Events\Frontend\Auth\UserLoggedOut;
use App\Exceptions\GeneralException;
//use App\Helpers\Auth\Auth;
//use App\Helpers\Frontend\Auth\Socialite;
use App\Http\Controllers\Controller;
use App\Http\Utilities\NotificationIos;
use App\Http\Utilities\PushNotification;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Socialite;
use Auth;
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
        $authUser = $this->findOrCreateUser($user, $provider);
        //auth::login($authUser,true);
        // return redirect($this->redirectTo);
         return response()->json($authUser) ;
    }
    public function findOrCreateUser($user, $provider){
        $authUser =SocialLogin::where('provider_id',$user->id)->first();
        if($authUser){
         $my_account = User::where('email',$user->email)->first();
         $passportToken = $my_account->createToken('API Access Token');
         $passportToken->token->save();
         $token = $passportToken->accessToken;
         return response()->json([
            'user'   => $my_account,
            'token'     => $token,
            'message'   => trans('api.messages.login.success'),
        ]);
        }
        $my_user = new User();
         $my_user->create ([
            'first_name'=> $user->name,
            'email'=>$user->email, 

        ])->socialLoginTable()->create([  
                'provider'=> strtoupper($provider),
                'provider_id' =>$user->id,
            ]);
            $my_account = User::where('email',$user->email)->first();
            $passportToken = $my_account->createToken('API Access Token');
            $passportToken->token->save();
            $token = $passportToken->accessToken;
            return response()->json([
               'user'   => $my_account,
               'token'     => $token,
               'message'   => trans('api.messages.login.success'),
               ]);
        
    }
    //======================================================================
}
