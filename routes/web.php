<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\shortUrlController;
use App\Http\Controllers\urlDetailController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\ProfileController;
//==================home route.................................
Route::get('/', function () {
    return view('frontend.index');
})->name('home');

Auth::routes();

Route::get('/logout',[LogoutController::class,'logout'])->name('logout');
//create short url=======================================
Route::post('/short',[shortUrlController::class,'createShortUrl'])->name('url.create.short');
Route::get('/{short_url}',[shortUrlController::class,'shortUrl'])->name('url.short');

//=================================url details routes.
Route::get('/url/details',[urlDetailController::class,'showUrlDetails'])->name('url.details');

//================delete the short url=======================================
Route::get('/delete/url/{id}',[shortUrlController::class,'deleteUrl'])->name('url.delete');

