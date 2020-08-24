<?php

namespace App\Http\Controllers\Api\V1;
use App\Models\Access\PasswordReset\PasswordReset;
use App\Notifications\Frontend\Auth\UserNeedsPasswordReset;
use App\Notifications\Frontend\Auth\PasswordResetSuccess;
use App\Repositories\Frontend\Access\User\UserRepository;
use Illuminate\Http\Request;
use Validator;
use Carbon\Carbon;

class ForgotPasswordController extends APIController
{
    /**
     * __construct.
     *
     * @param $repository
     */
    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }

  
    /**
     * Send a reset link to the given user.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function sendResetLinkEmail(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'email' => 'required|email',
        ]);

        if ($validation->fails()) {
            return $this->throwValidation($validation->messages()->first());
        }

        $user = $this->repository->findByEmail($request->get('email'));

        if (!$user) {
            return $this->respondNotFound(trans('api.messages.forgot_password.validation.email_not_found'));
        }

        $token = $this->repository->saveToken();

        $user->notify(new UserNeedsPasswordReset($token));

        return $this->respond([
            'status'    => 'ok',
            'token'     => $token,
            'message'   => trans('api.messages.forgot_password.success'),
        ]);
    }

     public function find($token)
    {
        $passwordReset = PasswordReset::where('token', $token)
            ->first();
        if (!$passwordReset)
            return response()->json([
                'message' => 'This password reset token is invalid.'
            ], 404);
        if (Carbon::parse($passwordReset->updated_at)->addMinutes(720)->isPast()) {
            $passwordReset->delete();
            return response()->json([
                'message' => 'This password reset token is invalid.'
            ], 404);
        }
        return redirect()->away('http://127.0.0.1:3000/auth/resetpassword/'.$passwordReset);
    }

      public function resetPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password'              => 'required|string|min:8',
            'password_confirmation' => 'required|same:password',
            'token' => 'required|string'
        ]);

        $passwordReset = PasswordReset::where('token', $request->get('token'))->first();


        if (!$passwordReset)
            return response()->json([
                'message' => 'This password reset token is invalid.'
            ], 404);
        $user = $this->repository->findByEmail($request->get('email'));
        if (!$user)
            return response()->json([
                'message' => 'We can not find a user with that e-mail address.'
            ], 404);
        $user->password = bcrypt($request->password);
        $user->save();
        $user->notify(new PasswordResetSuccess($passwordReset));
        return response()->json($user);
    }
   
    public function redirectAfterConfirm(){
        return redirect('http://www.shapelist.com/');

    }

   
}
