<?php
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MotorcycleController;
use App\Http\Controllers\TravelController;
use App\Http\Controllers\RatingController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
})->name('home');

Route::get('/proximamente', function () {
    return view('proximamente');
});

Route::get('/conocenos', function () {
    return view('conocenos');
});


Route::middleware('guest')->group(function () {
    Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register.form');
    Route::post('/register', [AuthController::class, 'register'])->name('register');
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login.form');
    Route::post('/dashboard', [AuthController::class, 'login'])->name('login');
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('change-password', function() {
    return view('auth.password');
})->middleware('auth')->name('password.change');

Route::post('update-password', [AuthController::class, 'updatePassword'])->middleware('auth')->name('password.update');

Route::get('/password-updated-success', function () {
    return view('menssage');
})->name('menssage');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware('auth')->name('dashboard');

Route::get('profile/create', [ProfileController::class, 'create'])->name('profile.create');
Route::post('profile', [ProfileController::class, 'store'])->name('profile.store');

Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::get('/profile/{id}/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile/{id}', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile/{id}', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/motorcycles/create', [MotorcycleController::class, 'create'])->name('motorcycles.create');
Route::post('/motorcycles', [MotorcycleController::class, 'store'])->name('motorcycles.store');

Route::middleware('auth')->group(function () {
    Route::resource('travels', TravelController::class)->except(['edit', 'update', 'destroy']);

    Route::patch('travels/{travel}/accept', [TravelController::class, 'accept'])->name('travels.accept');
    Route::patch('travels/{travel}/complete', [TravelController::class, 'complete'])->name('travels.complete');

    Route::post('/travels/rate', [TravelController::class, 'rate'])->name('travels.rate');
});

