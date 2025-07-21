<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use  \Illuminate\Validation\ValidationException; 

class SessionController extends Controller
{
    public function create() {
        return view('auth.login');
    }
    public function store() {
        //validate
        $attribute = request()->validate([
            'email' => ['required', 'email'],
            'password' => ['required']
        ]);

        //attempt to login the user
        if(!Auth::attempt($attribute)) {
            /**
             * Throws a ValidationException with custom error messages.
             *
             * @throws \Illuminate\Validation\ValidationException
             */
            throw ValidationException::withMessages([
                'email' => 'Sorry, credentials do not match'
            ]);
        }

        // regenerate the session token
        request()->session()->regenerate();

        //redirect
        return redirect('/jobs');
    }
    public function destroy() {
        Auth::logout();
        return redirect('/');
    }
}
