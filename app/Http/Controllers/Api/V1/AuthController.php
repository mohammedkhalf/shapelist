<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Access\User\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;
use Illuminate\Support\Facades\Hash;



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
                return $this->throwValidation(trans('api.messages.login.failed'));
            }

            $user = $request->user();

            $passportToken = $user->createToken('API Access Token');

            // Save generated token
            $passportToken->token->save();

            $token = $passportToken->accessToken;
        } catch (\Exception $e) {
            return $this->respondInternalError($e->getMessage());
        }

        return $this->respond([
            'user'      => $user,
            'message'   => trans('api.messages.login.success'),
            'token'     => $token,
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

}
