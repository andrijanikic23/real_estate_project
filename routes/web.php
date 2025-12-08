<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PropertyController;
use App\Http\Controllers\PropertyImageController;
use Illuminate\Support\Facades\Route;


Route::post('properties/bookmark', [PropertyController::class, 'like'])->name('properties.bookmark');
Route::get('properties/search', [PropertyController::class, 'filter'])->name('properties.filter');
Route::get('properties/posted', [PropertyController::class, 'posted'])->name('properties.posted')->middleware('auth');
Route::delete('image/delete/{image}', [PropertyImageController::class, 'deleteImage'])->name('image.delete');
Route::resource('properties', PropertyController::class)
    ->middlewareFor('create', 'auth');



Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
