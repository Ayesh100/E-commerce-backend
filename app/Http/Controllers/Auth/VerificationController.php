<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Customer;
use Illuminate\Auth\Events\Verified;
use Illuminate\Support\Facades\URL;


class VerificationController extends Controller
{
    public function verify(Request $request)
    {
        if (! URL::hasValidSignature($request)) {
        return redirect('https://myreactecommerce.netlify.app/verify-status?status=error&message=Invalid or expired signature');
        }
        // Retrieve user by id from the route parameter
        $user = Customer::find($request->route('id'));

        if (!$user) {
            return redirect('https://myreactecommerce.netlify.app/verify-status?status=error&message=User not found');
        }

        // Validate the hash from the URL matches the hash of the user's email
        if (! hash_equals((string) $request->route('hash'), sha1($user->getEmailForVerification()))) {
            return redirect('https://myreactecommerce.netlify.app/verify-status?status=error&message=Invalid verification link');
        }

        // Check if the email is already verified
        if ($user->hasVerifiedEmail()) {
            return redirect('https://myreactecommerce.netlify.app/login?verified=1&message=Email already verified');
        }

        // Mark the email as verified
        $user->markEmailAsVerified();

        // Fire the Verified event
        event(new Verified($user));

        return redirect('https://myreactecommerce.netlify.app/login?verified=1&message=Email verified successfully');

    }

    public function resendVerificationEmail(Request $request)
    {
        $user = Customer::where('email', $request->email)->first();

        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        if ($user->hasVerifiedEmail()) {
            return response()->json(['message' => 'Email is already verified'], 400);
        }

        $user->sendEmailVerificationNotification();

        return response()->json(['message' => 'Verification email resent successfully'], 200);
    }
}
