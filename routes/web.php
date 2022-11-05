<?php

use App\Http\Controllers\SecretFriendController;
use App\Http\Controllers\UserController;
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

Route::get('/', [UserController::class, 'index'])->name('home');

Route::group(['middleware' => ['auth']], function () {

    /* Rotas de amigo secreto. */
    Route::prefix('secretfriend')->group(function () {
        Route::get('/', [SecretFriendController::class, 'index'])->name('secretfriend-index');
        Route::get('/sortfriends', [SecretFriendController::class, 'viewSortFriends'])->name('secretfriend-viewsortfriends');
        Route::get('/sortallfriends', [SecretFriendController::class, 'sortAllFriends'])->name('secretfriend-sortallFriends');
        Route::get('/export/friend', [SecretFriendController::class, 'exportPdf'])->name('secretfriend-exportpdf');
    });

    /* Rotas de empresas. */
    Route::prefix('user')->group(function () {
        Route::get('/edit', [UserController::class, 'edit'])->name('user-edit');
        Route::post('/update', [UserController::class, 'update'])->name('user-update');
    });
});

/* Rotas de criação de participantes. */ 
Route::get('/register', [UserController::class, 'register'])->name('register');
Route::post('/register', [UserController::class, 'store']);

Route::get('/sendemail', [SecretFriendController::class, 'sendEmail'])->name('sendemail');

require __DIR__.'/auth.php';