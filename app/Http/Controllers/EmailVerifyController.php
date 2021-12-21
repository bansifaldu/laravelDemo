<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Auth\Events\Verified;
use Illuminate\Auth\Access\AuthorizationException;

class EmailVerifyController extends Controller
{   
    public function __construct()
    {
        $this->middleware('signed')->only('verify');
        $this->middleware('throttle:6,1')->only('verify', 'resend');
    }  

    public function show(Request $request)
    {
        return $request->user()->hasVerifiedEmail()
                        ? redirect($this->redirectPath())
                        : view('AdminAuth.verify');
    }

    /**
     * Mark the authenticated user's email address as verified.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function verify(Request $request)
{
    $user = User::find($request->route('id'));

    if (!hash_equals((string) $request->route('hash'), sha1($user->getEmailForVerification()))) {
        throw new AuthorizationException;
    }

    if ($user->markEmailAsVerified())
        event(new Verified($user));

    return redirect($this->redirectPath())->with('verified', true);
}

    /**
     * The user has been verified.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return mixed
     */
    protected function verified(Request $request)
    {
        //
    }

    /**
     * Resend the email verification notification.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
     */
    public function resend(Request $request)
    {
        if ($user->hasVerifiedEmail()) {
            return $request->wantsJson()
                        ? new JsonResponse([], 204)
                        : redirect($this->redirectPath());
        }

        $user->sendEmailVerificationNotification();

        return $request->wantsJson()
                    ? new JsonResponse([], 202)
                    : back()->with('resent', true);
    }
    public function redirectPath()
    {
        if (method_exists($this, 'redirectTo')) {
            return $this->redirectTo();
        }

        return property_exists($this, 'redirectTo') ? $this->redirectTo :'/admin/login';
    }
}
