<?php

use App\Http\Controllers\ArchivoController;
use App\Http\Controllers\InversionistasController;
use App\Http\Controllers\user as ControllersUser;
use App\Models\User;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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
    return Inertia::render('Auth/Login', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
        
    ]);
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        $users = User::all();
        return Inertia::render('Dashboard',[ 'users' => $users]);
    })->name('dashboard');
});

Route::apiResource('/main', InversionistasController::class);

Route::apiResource('/archivo', ArchivoController::class);
Route::apiResource('/user', ControllersUser::class );