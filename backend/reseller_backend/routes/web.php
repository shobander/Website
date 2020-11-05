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
    ->get('/dashboard/{order_chunk_no?}', function($order_chunk_no= 1) {
        // $order_chunk_no is needed to facilitate loading of orders in batches.
        // It is passed over to the view and used in there.
        $user_controller= new UserController();
        return $user_controller->dashboard($order_chunk_no);
    })
    ->name('dashboard');

// Profile Page
Route::get($prefix . "/profile", [UserController::class, "profile"])
    ->name("users.profile");

// Store New User
Route::post($prefix, [UserController::class, "store"])
    ->name('users.store');

// LOGOUT
Route::get("/logout", [UserController::class, "logout"]);

/**
 *  P   R   O   D   U   C   T   S
 */
$prefix="/products";