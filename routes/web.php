<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Home\HomeSlideController;
use App\Http\Controllers\Home\AboutController;
use Illuminate\Support\Facades\Route;
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

Route::get('/', function () {
    return view('frontend.index');
});


Route::middleware(['auth', 'verified'])->prefix('admin')->controller(AdminController::class)->group(function(){
    Route::get('/logout', 'destroy')->name('admin.logout');
    Route::get('/profile', 'profile')->name('admin.profile');
    Route::get('/profile/edit', 'edit')->name('admin.profile.edit');
    Route::get('/change/password', 'changePassword')->name('change.password');

    Route::post('/profile/store', 'store')->name('admin.profile.store');
    Route::post('/update/password', 'updatePassword')->name('admin.update.password');
});

Route::controller(HomeSlideController::class)->group(function(){
    Route::get('/home/slide', 'homeSlider')->name('home.slider');
    Route::middleware(['auth', 'verified'])->prefix('admin')->post('/update/slide', 'updateSlider')->name('update.slider');
});

Route::controller(AboutController::class)->group(function(){
    Route::get('/about/page', 'aboutPage')->name('about.page');
    Route::get('/about', 'homeAbout')->name('home.about');
    Route::post('/update/about', 'updateAbout')->name('update.about');
});

Route::get('/dashboard', function () {
    return view('admin.index');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
