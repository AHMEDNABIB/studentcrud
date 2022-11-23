<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\SampleController;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});


// Route::controller(SampleController::class)->group(function(){

//     Route::get('login', 'index')->name('login');

//     Route::get('registration', 'registration')->name('registration');
//     Route::post('validate_registration', 'validate_registration')->name('sample.validate_registration');
//        Route::post('validate_login', 'validate_login')->name('sample.validate_login');

//     Route::get('dashboard', 'dashboard')->name('dashboard');

//     Route::get('logout', 'logout')->name('logout');

 

// });


Route::resource('users', UserController::class);

Route::get('/dashboard', function () {

    // if (Auth::user()->is_Admin())
    //     return view('dashboard');

    
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';