<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public  function index()
    {
    }

    public function login(Request $request)
    {
        try {
            $request->validate([
                'email' => 'required|email',
                'password' => 'required',
            ]);

            $user = User::where('email', $request->email)->first();

            if ($user && $user->password === md5($request->password)) {
                Auth::login($user);
                return redirect()->route('dashboard');
            } else {
                return redirect()->route('auth-login')->with('error', 'Invalid credentials');
            }
        } catch (\Exception $e) {
            return redirect()->route('auth-login')->withErrors([
                'message' => 'An error occurred during login', 'error' => $e->getMessage()
            ]);
        }
    }


    public function logout()
    {
        Auth::logout();

        return redirect('http://localhost:8080/sikimon_r/Home');
    }
}
