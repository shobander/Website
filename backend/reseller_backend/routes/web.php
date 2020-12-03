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

// DASHBOARD
Route::middleware(['auth:sanctum', 'verified'])
    ->get('/dashboard', [UserController::class, "dashboard"])
    ->name('dashboard');

// Dashboard more orders
Route::get('/dashboard/{chunk_size}/{order_chunk_no}', [UserController::class, "dashboard_orders"])
    ->name('dashboard_orders')
    ->middleware(['auth:sanctum', 'verified']);

// Store images
// Route::post('/store_images')

// Profile Page
Route::get("/admin/profile", [UserController::class, "profile"])
    ->name("admin.profile")
    ->middleware(['auth:sanctum', 'verified']);

// Store New User
Route::post("/admin/store", [UserController::class, "store"])
    ->name('admin.store')
    ->middleware(['auth:sanctum', 'verified']);

// Delete User account
Route::post("/admin/delete", [UserController::class, "delete"])
    ->name('admin.delete')
    ->middleware(['auth:sanctum', 'verified']);


// Change Password
Route::post("/admin/change_password", [UserController::class, "change_password"])
    ->name('admin.change_password')
    ->middleware(['auth:sanctum', 'verified']);

// LOGOUT
Route::get("/logout", [UserController::class, "logout"]);

/**
 *  P   R   O   D   U   C   T   S
 */
$prefix="/products";