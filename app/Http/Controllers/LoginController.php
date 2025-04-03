<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\RedirectResponse;

class LoginController extends Controller
{
    public function index(){
        return Inertia::render('Login', [
            'active' => 'home',
        ]);
    }

    public function authenticate(Request $request): RedirectResponse{
        $credentials = $request->validate([
            'username' => ['required'],
            'password' => ['required']
        ]);

        if(Auth::attempt($credentials)){
            $request->session()->regenerate();
 
            return redirect()->route('phones.index');
        }

        return back()->with('loginError','Login gagal!');

       
    }

    public function logout(Request $request){
        Auth::logout();
 
        $request->session()->invalidate();
     
        $request->session()->regenerateToken();
     
        return redirect('/');

    }
}
