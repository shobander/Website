<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\UserController;


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



/**
 *  A   D   M   I   N
 */

$prefix="";

// DASHBOARD
Route::middleware(['auth:sanctum', 'verified'])
    ->get('/dashboard', [UserController::class, "dashboard"])
    ->name('dashboard');

// Profile Page
Route::get($prefix . "/profile", [ProductController::class, "profile"])
    ->name("users.profile");

// Store New User
Route::post($prefix, [ProductController::class, "store"])
    ->name('users.store');

// LOGOUT
Route::get("/logout", [UserController::class, "logout"]);

/**
 *  P   R   O   D   U   C   T   S
 */
$prefix="/products";