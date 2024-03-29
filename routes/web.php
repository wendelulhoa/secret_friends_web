<?php

use App\Http\Controllers\ManifestController;
use App\Http\Controllers\PushNotificationController;
use App\Http\Controllers\SecretFriendController;
use App\Http\Controllers\StakeController;
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

Route::get('/manifestcustom.json', [ManifestController::class, 'index'])->name('manifest');

/* Rotas de criação de participantes. */ 
Route::get('/register', [UserController::class, 'register'])->name('register');
Route::post('/register', [UserController::class, 'store']);

Route::get('/sendemail', [SecretFriendController::class, 'sendEmail'])->name('sendemail');

/* Rotas de amigo secreto. */
Route::prefix('pushnotification')->group(function () {
    /* Cria uma nova notificação. */ 
    Route::get('/new/notification', [PushNotificationController::class, 'createNotification'])->name('pushnotification-new-notification');
    
    /* Cria um novo usuário que */ 
    Route::post('/store/user', [PushNotificationController::class, 'createUser'])->name('pushnotification-store-user');
});

/**/ 
Route::get('/stake', [StakeController::class, 'index'])->name('stake-index');

// 
Route::get('/getplays', [StakeController::class, 'getPlays'])->name('getplays');
Route::any('/setPlays', [StakeController::class, 'setPlays'])->name('setPlays');

/**/ 
Route::get('/getMines', [StakeController::class, 'getMines'])->name('getMines');
Route::any('/setMines', [StakeController::class, 'setMines'])->name('setMines');

require __DIR__.'/auth.php';