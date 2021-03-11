<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoutingController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserAuth;
use App\Http\Controllers\SignupController;

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

Auth::routes();
Route::view("login",'auth/login')->name('login');

Route::view("register",'auth/register')->name('register');
Route::view("dash",'dashboard')->name('dash');

Route::get('/show/{id}',[PostController::class, 'show'])->name('show');

// Route::get("/postlist", [PostController::class, 'index'])->name('postlist');

Route::get("postlist/{id}", [PostController::class, 'index'])->name('postlist');

Route::get("create", [PostController::class, 'create'])->name('create');
Route::get("edit/{id}", [PostController::class, 'edit'])->name('edit');
Route::post("update/{id}", [PostController::class, 'update'])->name('update');




Route::group(['middleware' => 'auth', 'prefix' => '/'], function () {
    Route::get('{first}/{second}/{third}',[RoutingController::class,'thirdLevel'])->name('third');

    Route::get('{first}/{second}', [RoutingController::class,'secondLevel'])->name('second');
    Route::get('{any}', [RoutingController::class,'root'])->name('any');
});
Route::get('', [RoutingController::class,'index'])->name('index');

// landing
// Route::get('', RoutingController::class,'index')->name('index');



Route::delete("/delete/{id}", [PostController::class, 'delete'])->name('delete');
Route::post("/stored", [PostController::class, 'store'])->name('stored');
Route::post("user", [UserAuth::class, 'userLogin']);
Route::post("register", [SignupController::class, 'userRegister']);



// Route::view("login", 'login');
//Route::view("crud",'crud');
Route::view("profile", 'profile');
//Route::view("signup", 'signup');
// Route::get('/logout', function () {
//     if (session()->has('user')) {
//         session()->pull('user');
//     }
//     return redirect('login');
// });


Route::get('login', function () {
    if (session()->has('email')) {
        // return redirect('postlist');
        return back();
    }
    return view('auth/login');
    // return redirect("{{route('second', ['auth', 'login'])}}");
});


Route::get('register', function () {
    if (session()->has('email')) {
        // return redirect('postlist');
        return back();
    }
    return view('auth/register');
});