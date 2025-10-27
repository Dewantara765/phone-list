<?php

namespace App\Http\Controllers;

use App\Models\User;
use Inertia\Inertia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Events\Registered;

class RegisterController extends Controller
{
    public function index(){
        return Inertia::render('Signup', [
            'active' => 'home',
        ]);
    }
    
    public function store(Request $request){
        $validatedData = $request->validate([
            'username' => ['required','min:3','unique:users'],
            'email' => ['required','email:dns','unique:users'],
            'password' => ['required','min:5'],
            'role' => 'member',
        ]);

        $validatedData['password'] = bcrypt($validatedData['password']);

        
    
        $newUser = User::create($validatedData);

        event(new Registered($newUser));
        
        Auth::login($newUser);
        
        if (! $request->user()->hasVerifiedEmail()) {
        return redirect()->route('verification.notice')
            ->with('pesan', 'Silakan verifikasi email Anda sebelum melanjutkan.');
    }
       
        $request->session()->flash('pesan','Daftar dan Login Akun berhasil');
        return redirect()->route('phones.index');
    }////
}
