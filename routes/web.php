<?php

use App\Http\Controllers\MentorController;
use App\Http\Controllers\WebinarController;
use Illuminate\Support\Facades\Route;

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
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::prefix('mentors')->group(function() {
    Route::name('mentors.')->group(function() {
        Route::get('/', [MentorController::class, 'index'])->name('index');
        Route::post('/', [MentorController::class, 'store'])->name('store');
        Route::get('/{id}', [MentorController::class, 'detail'])->name('detail');
        Route::post('/update', [MentorController::class, 'update'])->name('update');
        Route::get('/{id}/delete', [MentorController::class, 'delete'])->name('delete');
    });
});

Route::prefix('webinars')->group(function() {
    Route::name('webinars.')->group(function() {
        Route::prefix('categories')->group(function() {
            Route::name('categories.')->group(function() {
                Route::get('/', [WebinarController::class, 'categoriesIndex'])->name('index');
                Route::get('/{slug}/check', [WebinarController::class, 'categoriesSlug'])->name('slug');
                Route::post('/', [WebinarController::class, 'categoriesStore'])->name('store');
                Route::get('/{id}', [WebinarController::class, 'categoriesDetail'])->name('detail');
                Route::post('/update', [WebinarController::class, 'categoriesUpdate'])->name('update');
                Route::get('/{id}/delete', [WebinarController::class, 'categoriesDelete'])->name('delete');
            });
        });
        Route::get('/', [WebinarController::class, 'index'])->name('index');
        Route::post('/', [WebinarController::class, 'store'])->name('store');
        Route::get('/{id}', [WebinarController::class, 'detail'])->name('detail');
        Route::post('/update', [WebinarController::class, 'update'])->name('update');
        Route::get('/{id}/delete', [WebinarController::class, 'delete'])->name('delete');
    });
});
