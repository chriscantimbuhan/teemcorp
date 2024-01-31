<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\FinancialModelController;
use App\Http\Controllers\API\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('/user-sign-up', [UserController::class, 'signUp'])->name('user-sign-up');
Route::post('/user-login', [AuthController::class, 'login'])->name('user-login');


Route::middleware(['auth:sanctum'])->group(function () {
    Route::prefix('financial-model')
    ->as('financial-model.')
    ->group(function () {
        Route::get('/search', [FinancialModelController::class, 'search'])
            ->name('search');

        Route::get('/options', [FinancialModelController::class, 'options'])->name('options');
        Route::get('/search-types', [FinancialModelController::class, 'searchTypes'])->name('search-types');
    });

    Route::delete('/logout', [AuthController::class, 'logout'])->name('logout');
});
