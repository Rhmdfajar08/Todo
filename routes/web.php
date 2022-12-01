<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TodoController;
use App\Http\Controllers\LogoutController;
use App\Http\Conrollers\RegisterController;
use App\Http\Controllers\LoginController;
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
Route::get('/', [TodoController::class, 'index'])->middleware('isGuest');

Route::get('register', [TodoController::class, 'registerPage'])->name('register');

Route::get('register', [TodoController::class, 'logout'])->name('logout');

// Route::get('/dashboard', function () {return view('dashboard'); })->middleware('isLogin') ;
// Route::post('/', [TodoController::class, 'login'])->name('login baru');

Route::post('/',
 [LoginController::class,
'login'])->name('login.auth');

Route::get('/register', 
 [TodoController::class,'registerPage'])->name('register');

 Route::get('/dashboard', function () {
    return view('dashboard');
 })->middleware('isLogin');

 Route::post('/register', [TodoController::class, 'register']);
//  Route::post('/login', [LoginController::class, 'login']);

 Route::get('logout', [LogoutController::class, 'logout'])->name('logout');

Route::middleware('isLogin')->group(function() {
   Route::get('/dashboard', function () {return view('dashboard'); });
   Route::get('/create',[TodoController::class,'create'])->name('create');
   Route::post('/store',[TodoController::class, 'store'])->name ('store');
   Route::get('/data',[TodoController::class, 'data'])->name('data');
   route::get('/edit/{id}', [TodoController::class,'edit'])->name('edit');
   route::patch('/update/{id}', [TodoController::class, 'update'])->name('update');
   route::delete('/delete/{id}',[TodoController::class,'destroy'])->name('destroy');
});