<?php

namespace App\Http\Controllers;

use App\Http\Controllers\AuthSessionController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CardController;
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

Route::get('/home', [HomeController::class, 'index'])->name('dashboard');
Route::group(['prefix' => 'user', 'as' => 'user.'], function () {
    Route::get('/{id}/show', [UserController::class, 'show'])->name('user_info.show');
    Route::get('/{id}/profile', [UserController::class, 'user_profile'])->name('profile.info');
    Route::post('/update/profile', [UserController::class, 'update_user_profile'])->name('update.profile');
    Route::get('/{id}/change-password', [UserController::class, 'change_password'])->name('change.password');
    Route::patch('user/{id}/change-password', [UserController::class, 'password_update'])->name('update.password');
    Route::get('/{id}/screen_lock', [UserController::class, 'screen_lock'])->name('screen.lock');
});
Route::post('/logout', [AuthSessionController::class, 'destroy'])
    ->name('logout');

Route::group(['prefix' => 'cards', 'as' => 'cards.'], function () {
    Route::get('/', [CardController::class, 'index'])->name('index');
    Route::get('/show/{id}', [CardController::class, 'show'])->name('show');
    Route::get('/create', [CardController::class, 'create'])->name('create');
    Route::get('/edit/{id}', [CardController::class, 'edit'])->name('edit');
    Route::get('/delete/{id}', [CardController::class, 'delete'])->name('delete');

    // Axios routes
    Route::post('/card-store', [CardController::class, 'store_card'])->name('store_card');
    Route::post('/card-update', [CardController::class, 'update_card'])->name('update_card');
    Route::get('/get-card-details', [CardController::class, 'get_card_details'])->name('get_card_details');
    Route::post('/store-card-attachment', [CardController::class, 'store_card_attachment'])->name('store_card_attachment');
    Route::post('/remove-card-attachment', [CardController::class, 'remove_card_attachment'])->name('remove_card_attachment');
    Route::post('/store-card-checklist', [CardController::class, 'store_card_checklist'])->name('store_card_checklist');
    Route::get('/get-checklist-details', [CardController::class, 'get_checklist_details'])->name('get_checklist_details');
    Route::post('/remove-card-checklist', [CardController::class, 'remove_card_checklist'])->name('remove_card_checklist');
    Route::post('/store-card-task', [CardController::class, 'store_card_task'])->name('store_card_task');
    Route::get('/get-task-details', [CardController::class, 'get_task_details'])->name('get_task_details');
    Route::post('/remove-card-task', [CardController::class, 'remove_card_task'])->name('remove_card_task');
});
