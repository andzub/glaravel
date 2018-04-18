<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use App\Http\Controllers\Auth\Session;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;


    /**
     * Create or login a new user instance after a valid registration.
     *
     * @return \App\User
     */
    protected function create()
    {   
        // Validation input data
        $this->validate(request(), [
            'name' => 'required|string|max:255',
            'password' => 'required|string|min:5',
        ]);

        // Check of user if name and password equal, then login
        $results = User::where('name', request('name'))->get();
        foreach($results as $result) {

            if ($result['name'] == request('name') &&
                Hash::check(request('password'), $result['password'])) {
                Auth::login($result);
                return redirect('/');
            } else {
                $this->validate(request(), [
                    'name' => 'required|string|max:255|unique:users',
                ]);
            }
        }

        $user = User::create([
            'name' => request('name'),
            'password' => Hash::make(request('password')),
        ]);

        Auth::login($user);
        return redirect('/');
    }

     /**
     * Log the user out of the application.
     *
     * @return \Illuminate\Http\Response
     */
    public function logout()
    {

        Auth::logout();
        return redirect('/');
    }

}
