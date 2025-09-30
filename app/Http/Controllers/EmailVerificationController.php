<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

class EmailVerificationController extends Controller
{
    public function notice(){
        return Inertia::render('Auth/VerifyEmail',[
            'status' => session('status')
        ]);
    }

    public function handler(EmailVerificationRequest $request) {
    $request->fulfill();
 
    return redirect()->route('login.success');

}

public function resend (Request $request) {
    
    $request->user()->sendEmailVerificationNotification();
    return back()->with('status', 'Verification link sent!');

}
}
