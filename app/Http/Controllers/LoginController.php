<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class LoginController extends Controller
{
    /**
     * Handle logout functionality.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }

    /**
     * Handle login functionality.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
        $useFingerprint = $request->has('use_fingerprint');

        if (Auth::attempt($credentials)) {
            // Check if fingerprint data is sent
            if ($useFingerprint && $request->has('fingerprint')) {
                // Store or update the fingerprint data for the user
                $user = Auth::user();
                $user->fingerprint_data = $request->input('fingerprint');
                $user->save();
            }

            return redirect()->intended('/home');
        }

        return back()->withErrors(['email' => 'The provided credentials do not match our records.']);
    }
}
