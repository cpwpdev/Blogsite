<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function register(Request $request){
        if($request->isMethod('get')){
            return view('register');
        }
        $request->validate([
                'name' => 'required',
                'email' => 'required|email|unique:users',
                'password' => 'required|min:6',
            ]);

            User::create([
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'password' => Hash::make($request->input('password')),
            ]);
            return redirect()->route('login')->with('Success','Your Account has been created');

    }
    public function login(Request $request){
        if($request->isMethod('get')){
            return view('login');
        }

       $credentail = $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);
        if(Auth::attempt( $credentail)){
            return redirect()->route('home')->with('Success','You are LoggedIN');
        }
        return redirect()->route('login')->withErrors('Login In-Correct');

        
    }

    public function logout(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('home')->withErrors('Logout');

    }
}
