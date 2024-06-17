<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Register
     */
    public function save(Request $requst) {
        if(Auth::check()) {
            return redirect('/home');
        }

        $validatedFields = $requst->validate([
            'name' => 'required|string',
            'email' => 'required|email',
            'password' => 'required'
        ]);
        if (User::where('email', $validatedFields['email'])->exists()) {
            return redirect('/registration')->withErrors([
                'email' => 'Error, user with this email already exist!!!'
            ]);
        }

        $email = $validatedFields['email'];
        $user = User::create($validatedFields);
        if ($user) {
            Auth::login($user);
            $requst->session()->put('user_id', User::where('email', $email)->value("id"));
            $requst->session()->put('user_name', User::where('email', $email)->value("name"));
            return redirect('/home');
        }

        return redirect('/login')->withErrors([
            'formError' => 'Error, user not create!!!'
        ]);
    }

    /**
     * Log in
     */
    public function login(Request $requst) {
        if(Auth::check()) {
            return redirect('/home');
        }

        $validatedFields = $requst->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);
        $email = $validatedFields['email'];

        if(Auth::attempt($validatedFields)) {
            $requst->session()->put('user_id', User::where('email', $email)->value("id"));
            $requst->session()->put('user_name', User::where('email', $email)->value("name"));
            return redirect('/home');
        }

        return redirect('/login')->withErrors([
            'formError' => 'Error, you are not sign in!!!'
        ]);
    }

    /**
     * Delete user.
     */
    public function delete(string $id) {
        Auth::logout();
        User::findOrFail($id)->delete();
        return redirect('/login');
    }
}
