<?php

use App\Http\Controllers\ListingsController;
use App\Http\Controllers\UsersController;
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

/*
 * Naming convention
 *
 * index -> Show all resources
 * show -> Show a specific resource
 * create -> Show a form to create a resource
 * store -> Create a resource
 * edit -> Show a form to edit a resource
 * update -> Update a specific resource
 * destroy -> Delete a specific resource
 * */


// LISTINGS
Route::get('/', [ListingsController::class, 'index']); // View
Route::post('/listings', [ListingsController::class, 'store'])->middleware(['auth']);
Route::get('/listings/create', [ListingsController::class, 'create'])->middleware(['auth']); // View
Route::get('/listings/manage', [ListingsController::class, 'manage'])->middleware(['auth']); // View

/*
 * Applying route model binding
 *
 * Route model binding automatically takes the model id passed as
 * uri parameter, and search for that model in the database, if the model
 * is not found, a 404 error is sent to the client {{abort(404)}}
 * */

Route::get('/listings/{listing}/edit', [ListingsController::class, 'edit'])->middleware(['auth']);// View
Route::put('/listings/{listing}', [ListingsController::class, 'update'])->middleware(['auth']);
Route::delete('/listings/{listing}', [ListingsController::class, 'destroy'])->middleware(['auth']);
Route::get('/listings/{listing}', [ListingsController::class, 'show']); // View

// USERS - AUTHENTICATION
Route::get('/register', [UsersController::class, 'create'])->middleware(['guest']);;
Route::get('/login', [UsersController::class, 'login'])->name('login')->middleware(['guest']);;
Route::post('/authentication', [UsersController::class, 'authenticate']);
Route::post('/users', [UsersController::class, 'store']);
Route::post('/logout', [UsersController::class, 'logout'])->middleware(['auth']);
