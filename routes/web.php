<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PropertyController;
use App\Http\Controllers\PropertyImageController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\UserFavouriteController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('properties.index');
});

Route::controller(PropertyController::class)->group(function(){
    Route::post('properties/bookmark', 'like')->name('properties.bookmark');
    Route::get('properties/search', 'filter')->name('properties.filter');
    Route::get('properties/posted', 'posted')->name('properties.posted')->middleware('auth');
    Route::delete('image/delete/{image}', 'deleteImage')->name('image.delete');
    Route::get('properties/bookmarks', 'bookmark')->name('property.favourite')->middleware('auth');
});

Route::delete('user-favourite/delete/{favourite}', [UserFavouriteController::class, 'discard'])->name('user.favourite.delete');

Route::post('contact/sent', [QuestionController::class, 'sent'])->name('contact.sent');
Route::resource('properties', PropertyController::class)
    ->middlewareFor('create', 'auth');

Route::view('/contact', 'contact')->name('contact');



Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
