<?php

use Inertia\Inertia;
use App\Models\Phone;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PhoneController;
use App\Http\Controllers\RegisterController;

// Route::inertia('/','Home')->name('home');



// Route::resource('phones', PhoneController::class);
Route::get('/', [PhoneController::class, 'index'])
->name('phones.index');

Route::get('/phones/create', [PhoneController::class, 'create'])->name('phones.create')->middleware('auth');

Route::inertia('/about', 'About', ['user' => 'Dewantara'])->name('about');

Route::get('/search', [PhoneController::class, 'search'])->name('phones.search');

Route::get('/brand', function(){
    return Inertia::render('Brand',[
        'active' => 'brand',
    ]);
})->name('phones.brand');

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
    ->name('phones.edit')->middleware('auth');

Route::put('/phones/{phone}', [PhoneController::class,'update'])
    ->name('phones.update')->middleware('auth');

Route::delete('/phone/{phone}', [PhoneController::class,'destroy'])
    ->name('phones.destroy')->middleware('auth');


Route::post('/add',[PhoneController::class, 'store'])->name('phones.store')->middleware('auth');

