<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class AuthenticatedSessionController extends Controller
{
    public function create(){
        return view('auth.login');
    }
    
    public function store(Request $request)
{
    $credentials = $request->validate([
        'email' => ['required', 'email'],
        'password' => ['required'],
    ]);

    if (Auth::attempt($credentials)) {
        $request->session()->regenerate();

        $user = Auth::user();

        // Redirect based on role
        if ($user->hasRole('super-admin') || $user->hasRole('admin')) {
            return redirect()->intended('/home');
        } elseif ($user->hasRole('manager')) {
            return redirect()->intended('/admin/category');
        }elseif ($user->hasRole('customer-service')) {
            return redirect()->intended('/admin/orders');
        } elseif ($user->hasRole('order-manager')) {
            return redirect()->intended('/admin/orders');
        }  else {
            Auth::logout();
            return redirect('/login')->withErrors(['email' => 'Unauthorized access.']);
        }
    }

    throw ValidationException::withMessages([
        'email' => __('auth.failed'),
    ]);
}

    public function destroy(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
