<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Access\User\User;
use App\Models\SubscriptionDetail\SubscriptionDetail;
use App\Models\Location\Location;
use App\Models\Order\Order;
use App\Mail\resendConfirmationEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Notifications\Messages\MailMessage;
use Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use App\Models\OrderItem\OrderItem;
use App\Models\OrderPackage\OrderPackage;
use App\Rules\FilterStringRule;

class AuthController extends APIController
{
    
   
    /**
     * Log the user in.
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'email'    => 'required|email',
            'password' => 'required|min:4',
        ]);

        if ($validation->fails()) {
            return $this->throwValidation($validation->messages()->first());
        }

        $credentials = $request->only(['email', 'password']);

        try {
            if (!Auth::attempt($credentials)) {
                return $this->throwNotFound(trans('api.messages.login.failed'));
            }

            $user = $request->user();

            if( $user->confirmed == 0){

            Mail::to($user->email)->send(new resendConfirmationEmail($user));
            return $this->respondForbidden('please check your email to confirm your acount ..');            
            }

            $passportToken = $user->createToken('API Access Token');

            // Save generated token
            $passportToken->token->save();

            $token = $passportToken->accessToken;
        } catch (\Exception $e) {
            return $this->respondInternalError($e->getMessage());
        }


        $subscription = SubscriptionDetail::where('user_id',$user->id)->first();

        return $this->respond([
            'user'      => $user->makeHidden(['status','last_name','updated_at','created_at',
            'created_by','confirmed','is_term_accept','updated_by','deleted_at','confirmation_code']),
            'token'     => $token,
            'subscription_details'    => $subscription,
        ]);
    }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me()
    {
        return response()->json($this->guard()->user());
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout(Request $request)
    {
        try {
            $request->user()->token()->revoke();
        } catch (\Exception $e) {
            return $this->respondInternalError($e->getMessage());
        }

        return $this->respond([
            'message'   => trans('api.messages.logout.success'),
        ]);
    }

    /** get user data using id*/
    public function userData($id)
    {
        $userInfo = User::findOrFail($id);
        return $this->respond([
            'userInfo'   => $userInfo
        ]);
    }

    public function changePassword(Request $request)
    {
        // The passwords matches
        if (!(Hash::check($request->get('current-password'), Auth::user()->password))) 
        {
            return $this->respond([
                'message'   => 'Your current password does not 
                                matches with the password you provided. Please try again',
            ]);
        }
        //Current password and new password are same
        elseif(strcmp($request->get('current-password'), $request->get('new-password')) == 0)
        {
            return $this->respond([
                'message'   => 'New Password cannot be same as your current password.
                                 Please choose a different password.',
            ]);
        }
        else
        {
                $request->validate([
                    'current-password' => 'required',
                    'new-password' => 'required|string|min:6',
                    'confirm-new-password' => 'required|same:new-password'
                ]);
                //Change Password
                $user = Auth::user();
                $user->password = bcrypt($request->get('new-password'));
                $user->save();

                return $this->respond([
                    'message'   => 'Password changed successfully',
                ]);
        }
    }

    public function updateProfile(Request $request)
    {
        $request->validate([
            'first_name'    => ['required','max:50', new FilterStringRule],
            'email'         => ['required', 'email', 'max:255', Rule::unique('users')],
            'phone_number'  => 'required|min:10|numeric|regex:/(0)[0-9]{9}/',
        ]);
        $user = User::findOrFail(auth()->user()->id);
        $user->update($request->only('first_name','email','phone_number'));
        return $this->respond([
            'message'=>'Profile Updated Successfully',
            'user'=> $user,
        ]);

    }
    
    public function getUser(){
        $user = auth('api')->user()->makeHidden(['status','last_name','updated_at','created_at','created_by','confirmed','is_term_accept','updated_by','deleted_at']);
        $passportToken = $user->createToken('API Access Token');
        $passportToken->token->save();
        $token = $passportToken->accessToken;
        $subscription = SubscriptionDetail::where('user_id',$user->id)->first();
        $location = Location::where('user_id',auth()->guard('api')->user()->id)->first();
        $allOrders = Order::where('user_id',auth()->guard('api')->user()->id)->get();
        $cart = [
                'products'=> OrderItem::where(['order_id'=>null , 'user_id'=>auth()->guard('api')->user()->id])->get(),
                'packages'=>OrderPackage::where(['order_id'=>null , 'user_id'=>auth()->guard('api')->user()->id])->get()
            ];
        return $this->respond([
            'user'      => $user,
            'token'     => $token,
            'location'    => $location,
            'orders'    => $allOrders,   
            "cart"      =>   $cart,
            'subscription_details'    => $subscription,
        ]);
    }

   
}
