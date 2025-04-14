<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:customers',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $customer = Customer::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => bcrypt($validated['password']),
        ]);

        // Send email verification
        event(new Registered($customer));

        return response()->json([
            'message' => 'Registration successful. Please check your email to verify your account.'
        ], 201);
    }

    public function login(Request $request)
{
    $credentials = $request->validate([
        'email' => 'required|string|email',
        'password' => 'required|string',
    ]);

    $customer = Customer::where('email', $request->email)->first();

    if (!$customer || !Hash::check($request->password, $customer->password)) {
        return response()->json(['message' => 'Invalid credentials'], 401);
    }

    // ✅ Now checking email verification **after** password is verified
    if (is_null($customer->email_verified_at)) {
        return response()->json(['message' => 'Please verify your email before logging in.'], 403);
    }

    $token = $customer->createToken('authToken')->plainTextToken;

    return response()->json([
        'token' => $token,
        'user' => $customer,
    ]);
}


    public function user(Request $request)
    {
        return response()->json($request->user());
    }

    public function logout(Request $request)
    {
        // Revoke all tokens of the authenticated user
        $request->user()->tokens()->delete();

        return response()->json(['message' => 'Logged out successfully']);
    }
}
