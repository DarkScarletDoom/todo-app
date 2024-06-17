<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Home page
Route::get('/home', [HomeController::class, 'index'])->middleware('auth');

// Sign in
Route::get('/login', function(){
    if (Auth::check()) {
        return redirect(route('/home'));
    }
    return view('login');
});
Route::post('/login', [UserController::class, 'login']);

// Sign up
Route::get('/registration', function() {
    if (Auth::check()) {
        return redirect(route('/home'));
    }
    return view('registration'); 
});
Route::post('/registration', [UserController::class, 'save']);

// Logout
Route::get('/logout', function(){
    Auth::logout();
    return redirect('/login');
});

// Delete
Route::get('/delete/{user_id}', [UserController::class, 'delete']);


Route::group(['prefix' => 'task'], function() {
    Route::post('/', [TaskController::class, 'store']);
    Route::get('/', [TaskController::class, 'getList']);
    Route::get('/{task_id}', [TaskController::class, 'delete']);
});
