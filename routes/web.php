<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\AuthController;

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

Route::group(['prefix' => ''], function () {
    Route::get('/', [BlogController::class, 'index'])->name('blog.index');
    Route::get('/add-blog', [BlogController::class, 'create'])->name('blog.create')->middleware('auth');
    Route::post('/blogs', [BlogController::class, 'store'])->name('blog.store');
    Route::get('/blogs/{id}', [BlogController::class, 'show'])->name('blog.show');
    Route::delete('/blogs/{id}', [BlogController::class, 'destroy'])->name('blog.destroy');
    Route::put('/blogs/{id}', [BlogController::class, 'update'])->name('blog.update');
    Route::get('/blogs/{id}/edit', [BlogController::class, 'edit'])->name('blog.edit');
});

Route::group(['prefix'=> 'auth'], function ()  {
    Route::get('/register', [AuthController::class, 'showRegister'])->name('auth.show-register');
    Route::get('/login', [AuthController::class, 'showLogin'])->name('auth.show-login');
    Route::post('/register', [AuthController::class, 'register'])->name('auth.register');
    Route::post('/login', [AuthController::class, 'login'])->name('auth.login');
    Route::get('/logout', [AuthController::class, 'logout'])->name('auth.logout');

});