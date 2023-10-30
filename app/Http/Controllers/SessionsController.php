<?php

namespace App\Http\Controllers;

use Illuminate\Validation\ValidationException;

class SessionsController extends Controller
{
    public function create()
    {
        return view('sessions.create');
    }

    public function store()
    {
        // validate the request
        $attributes = request()->validate([
            //user is required to input email and password
            'email' => 'required|email',
            'password' => 'required'
        ]);

        // attempt to authenticate and log in the user
        // based on the provided credentials
        if (!auth()->attempt($attributes)){
            // If auth failed
            //One way to do it:
            /*
            return back()
                ->withInput()
                ->withErrors(['email'=>'Your provided credentials could not be verified.']);
            */
            //2nd way to do it:
            throw ValidationException::withMessages([
                'email'=>'Your provided credentials could not be verified.'
            ]);
        }

        session()->regenerate();
        // redirect with a success flash message
        return redirect('/')->with('success', 'Welcome back!');
    }

    public function destroy()
    {
        auth()->logout();
        return redirect('/')->with('success', 'Goodbye!');
    }
}
