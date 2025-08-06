<?php


use App\Http\Controllers\AuthController;
use App\Http\Controllers\MainController;
use App\Http\Middleware\CheckIsLogged;
use App\Http\Middleware\CheckIsNotLogged;
use Illuminate\Support\Facades\Route;

Route::middleware([CheckIsNotLogged::class])->group(function () {
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/loginSubmit', [AuthController::class, 'loginSubmit'])->name('loginSubmit');

});

Route::middleware([CheckIsLogged::class])->group(function () {
    Route::get('/', [MainController::class, 'index'])->name('index');

    Route::get('/newnote', [MainController::class, 'newNote'])->name('newnote');
    Route::get('/edit/{id}', [MainController::class, 'editNote'])->name('editnote');
    Route::get('/delete/{id}', [MainController::class, 'deleteNote'])->name('deletenote');

    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
});
    