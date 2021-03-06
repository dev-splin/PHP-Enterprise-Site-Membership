<?php

use App\Http\Controllers\member\CreateMemberController;
use App\Http\Controllers\MainController;
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

Route::get('/', [MainController::class, 'index' ]);

Route::prefix('/create-member')->group(function () {
    Route::get('/', [CreateMemberController::class, 'index' ]);
    Route::post('/check-email', [CreateMemberController::class, 'checkEmail']);
    Route::post('/send-email', [CreateMemberController::class, 'sendEmail']);
    Route::post('/', [CreateMemberController::class, 'create']);
});


