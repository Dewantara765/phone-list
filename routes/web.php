<?php

use Inertia\Inertia;
use App\Models\Phone;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PhoneController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\EmailVerificationController;

// Route::inertia('/','Home')->name('home');



// Route::resource('phones', PhoneController::class);
Route::get('/', [PhoneController::class, 'index'])
->name('phones.index');

Route::get('/phones/create', [PhoneController::class, 'create'])->name('phones.create')->middleware('auth');

Route::inertia('/about', 'About', ['user' => 'Dewantara'])->name('about');

Route::get('/search', [PhoneController::class, 'search'])->name('phones.search');

// Route::get('/brand', function(){
//     return Inertia::render('Brand',[
//         'active' => 'brand',
//     ]);
// })->name('phones.brand');

Route::get('/brand/{brand}', function (String $brand) {
    $phones = Phone::where('brand', $brand )->orderBy('id','desc')->paginate(10)->onEachSide(1);
    return Inertia::render('Home',[
        'phones' => $phones,
        'brand' => $brand,
        'active' => 'brand',
    ]);
});

Route::get('/compare', [PhoneController::class, 'compare'])->name('phones.compare');

Route::get('/phones/{phone:slug}', [PhoneController::class,'show'])
->name('phones.show');



Route::get('/autocomplete/search', [PhoneController::class, 'autocompleteSearch'])
->name('phones.autocompleteSearch');

Route::get('/daftar', [RegisterController::class, 'index'])
->name('signup');

Route::get('/masuk', [LoginController::class, 'index'])
->name('login');

Route::post('/signup', [RegisterController::class, 'store'])->name('signup.store');

Route::post('/login', [LoginController::class, 'authenticate'])->name('login.authenticate');

Route::post('/logout', [LoginController::class, 'logout'])->name('logout');



Route::get('/phones/{phone}/edit', [PhoneController::class,'edit'])
    ->name('phones.edit')->middleware(['auth', 'verified']);

Route::put('/phones/{phone}', [PhoneController::class,'update'])
    ->name('phones.update')->middleware(['auth', 'verified']);

Route::delete('/phone/{phone}', [PhoneController::class,'destroy'])
    ->name('phones.destroy')->middleware(['auth', 'verified']);

Route::post('/phones/{phone}/comments', [CommentController::class, 'store'])->name('phones.comments.store')->middleware(['auth']);


Route::post('/add',[PhoneController::class, 'store'])->name('phones.store')->middleware(['auth']);

Route::post('/phones/{phone}/like', [LikeController::class, 'toggle'])->middleware(['auth']);

Route::delete('/comments/{comment}', [CommentController::class, 'destroy'])
    ->middleware(['auth', 'verified'])
    ->name('comments.destroy');

Route::get('/email/verify', [EmailVerificationController::class, 'notice'])->middleware('auth')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', [EmailVerificationController::class, 'handler'])->middleware(['auth', 'signed', 'throttle:6,1'])->name('verification.verify');

Route::post('/email/verification-notification', [EmailVerificationController::class, 'resend'])->middleware(['auth', 'throttle:6,1'])->name('verification.send');

Route::get('/loginSuccess', function () {
    return Inertia::render('LoginSuccess');
})->name('login.success');
