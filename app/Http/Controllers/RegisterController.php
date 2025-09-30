<?php

namespace App\Http\Controllers;

use App\Models\User;
use Inertia\Inertia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        
        $token = Auth::login($newUser);
        
       
        $request->session()->flash('pesan','Daftar dan Login Akun berhasil');
        return redirect()->route('phones.index');
    }////
}
