<?php

namespace App\Http\Controllers\Api\V1;

use App\Repositories\Frontend\Access\User\UserRepository;
use Config;
use Illuminate\Http\Request;
use Validator;

class RegisterController extends APIController
{
    protected $repository;

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
     * Register User.
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'first_name'            => 'string|required',
            // 'last_name'             => 'nullable',
            'email'                 => 'required|email|unique:users',
            'password'              => 'required|min:8',
            'password_confirmation' => 'required|same:password',
            // 'phone_number'    => 'nullable|max:10|regex:/(0)[0-9]{9}/',
            // 'is_term_accept'        => 'required',
        ]);

        if ($validation->fails()) {
            return $this->throwValidation($validation->messages()->first());
        }

        $user = $this->repository->create($request->all());

        if (!Config::get('api.register.release_token')) {
            return $this->respondCreated([
                'message'  => trans('api.messages.registeration.success'),
            ]);
        }

        $passportToken = $user->createToken('API Access Token');

        // Save generated token
        $passportToken->token->save();

        $token = $passportToken->accessToken;

        return $this->respondCreated([
            'user'      => $user,
            'message'   => trans('api.messages.registeration.success'),
            // 'token'     => $token,
        ]);
    }
}
