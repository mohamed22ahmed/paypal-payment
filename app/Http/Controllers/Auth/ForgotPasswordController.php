<?php

namespace App\Http\Controllers\Auth;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Password;
use Illuminate\Validation\ValidationException;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Hash;
use Illuminate\Auth\Events\PasswordReset;
use DB;
use Mail;
use Illuminate\Support\Str;

class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails;

        public function sendPasswordResetLink(Request $request)
        {
            return $this->sendResetLinkEmail($request);
        }

        protected function sendResetLinkResponse(Request $request, $response)
        {
            return response()->json([
                'message' => 'Password reset email sent.',
                'data' => $response
            ]);
        }
         protected function sendResetLinkFailedResponse(Request $request, $response)
        {
            return response()->json(['message' => 'Email could not be sent to this email address.']);
        }


}
