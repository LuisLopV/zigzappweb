<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\MotorcycleController;
use App\Http\Controllers\TravelController;

/*Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');*/

//rutas api user
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/login', [AuthController::class, 'login']); 

Route::middleware('auth:api')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/update-password', [AuthController::class, 'updatePassword']);
});

//rutas api profile
Route::post('/profile', [ProfileController::class, 'store']);

Route::middleware('auth:api')->group(function () {
    Route::get('/profile', [ProfileController::class, 'index']);
    Route::get('/profile/{id}', [ProfileController::class, 'edit']);
    Route::put('/profile/{id}', [ProfileController::class, 'update']);
    Route::delete('/profile/{id}', [ProfileController::class, 'destroy']);
});

//Rutas api motorcycle

    Route::get('/motorcycles/create', [MotorcycleController::class, 'create']);
    Route::post('/motorcycles', [MotorcycleController::class, 'store']);

//Rutas api travel

Route::prefix('api')->middleware('auth:api')->group(function () {
    Route::get('travels', [TravelController::class, 'apiIndex'])->name('api.travels.index');
    Route::post('travels', [TravelController::class, 'apiStore'])->name('api.travels.store');
    Route::get('travels/{travel}', [TravelController::class, 'apiShow'])->name('api.travels.show');
    
    Route::patch('travels/{travel}/accept', [TravelController::class, 'apiAccept'])->name('api.travels.accept');
    Route::patch('travels/{travel}/complete', [TravelController::class, 'apiComplete'])->name('api.travels.complete');
    Route::post('/travels/rate', [TravelController::class, 'apiRate'])->name('api.travels.rate');
});

