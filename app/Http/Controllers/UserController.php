<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Log;
use App\Http\Requests\RegisterRequest;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function register_method(RegisterRequest $request)
    {
        $validated = $request->validated();

        // Create a new user
        $user = new \App\Models\User;
        $user->name = $validated['name'];
        $user->email = $validated['email'];
        $user->password = \Illuminate\Support\Facades\Hash::make($validated['password']);
        $user->save();// save into DB

        // Log the user in
        \Illuminate\Support\Facades\Auth::login($user);

        Log::info('Verification OK'); // Log the verification , see storage/logs/laravel.log
        return redirect('/');
    }

    public function logout_method(){
        auth()->logout();
        return redirect('/');
    }

    public function login_method(Request $request) {
        $incomingFields = $request->validate([
            'login_name' => 'required',
            'login_password' => 'required'
        ]);

        if (auth()->attempt(['name' => $incomingFields['login_name'],
                            'password' => $incomingFields['login_password']])) {
            $request->session()->regenerate();
            return redirect()->intended('/'); // Redirect to intended page after successful login
        }

        return back()->withErrors([ // Redirect back with errors if login attempt fails
            'login_name' => 'The provided credentials do not match our records.',
        ]);
    }
}