<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class RegisterController extends Controller
{
    public function create()
    {
        return view('register.create');
    }

    public function store()
    {
        $attributes = request()->validate([
            'name'=>'required|max:255',
            //the 2 folllowing lines do the same thing
            //'username'=>['required', 'min:3', 'max:255', Rule::unique('users' , 'username')],
            'username'=>'required|min:3|max:255|unique:users,username',
            //unique:users,email is to make sure the user does Not enter an exsiting email..
            //by checking from the users table, email coloumn
            'email'=>'required|email|max:255|unique:users,email',
            'password'=>'required|min:7|max:255'
        ]);

        //password encryption done in User.php instaed
        // $attributes['password'] = bcrypt($attributes['password']);

        //if validation passes, create the user
        $user = User::create($attributes);

        //log the user in
        auth()->login($user);

        //session()->flash('success', 'Your account has been created.');
        //redirect to the home page ->with the 'success' meassge to flash
        return redirect('/')->with('success', 'Your account has been created.');
    }
}
