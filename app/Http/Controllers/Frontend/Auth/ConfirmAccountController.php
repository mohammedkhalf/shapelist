<?php

namespace App\Http\Controllers\Frontend\Auth;

use App\Http\Controllers\Controller;
use App\Models\Access\User\User;
use App\Notifications\Frontend\Auth\UserNeedsConfirmation;
use App\Repositories\Frontend\Access\User\UserRepository;
use Redirect;
/**
 * Class ConfirmAccountController.
 */
class ConfirmAccountController extends Controller
{
    /**
     * @var UserRepository
     */
    protected $user;

    /**
     * ConfirmAccountController constructor.
     *
     * @param UserRepository $user
     */
    public function __construct(UserRepository $user)
    {
        $this->user = $user;
    }

    /**
     * @param $token
     *
     * @return mixed
     */
    public function confirm($token)
    {
        $url = url('https://www.shapelist.com');
        $this->user->confirmAccount($token);
        // return Redirect::away($url);

        return redirect()->route('v1.redirect.front');
    }

    /**
     * @param $user
     *
     * @return mixed
     */
    public function sendConfirmationEmail(User $user)
    {
        $user->notify(new UserNeedsConfirmation($user));
        return redirect()->route('v1.redirect.front');
        // return redirect()->route('frontend.auth.login')->withFlashSuccess(trans('exceptions.frontend.auth.confirmation.resent'));
    }
}
