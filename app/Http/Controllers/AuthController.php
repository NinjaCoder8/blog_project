<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    public function showRegister(){
        return view('auth-register');
    }
    public function showLogin(){
        return view('auth-login');
    }
    public function login(Request $request)
    {

        $validatedData = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);
    

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended(route('blog.index'));
        }

        return back()->withErrors([
            'password' => 'The provided credentials do not match our records.',
        ]);

    }

    public function register(Request $request)
    {
       $validatedData = $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed',
         
        ]);
       
        if (User::where('email', $request->email)->exists()) {
            return back()->withErrors([
                'email' => 'The provided email is already in use.',
            ]);
        }
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();
        // log the user in
        Auth::login($user);

        return redirect()->intended(route('blog.index'));
       
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->intended(route('blog.index'));
    }
    

}