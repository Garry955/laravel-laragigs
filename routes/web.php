<?php

use App\Models\Listing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ListingController;
use App\Http\Controllers\ProfileController;

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


// Route::get('/hello', function () {
//     return response('<h1>Hello world</h1>')
//         ->header('Content-Type','text/plain');
// });



// Route::get('/search', function (Request $request) {
    //     return($request->name . ' ' . $request->city);
    // });
    
    // Route::get('/posts/{id}', function ($id) {
        //      //die and dump and debug
        //     ddd($id);
        //     return response('Post ' . $id);
        // })->where('id', '[0-9]+');
        
//All listings
Route::get('/', [ListingController::class, 'index']);

//Show create form
Route::get('/listings/create', [ListingController::class, 'create']);

// Store listing
Route::post('/listings', [ListingController::class, 'store'])->middleware('auth');

//Show edit form
Route::get('/listings/{listing}/edit', [ListingController::class, 'edit'])->middleware('auth');

//Edit submit to update
Route::put('/listings/{listing}', [ListingController::class, 'update'])->middleware('auth');

//Delete submit to update
Route::delete('/listings/{listing}', [ListingController::class, 'destroy'])->middleware('auth');

//Manage listings
Route::get('/listings/manage', [ListingController::class, 'manage'])->middleware('auth');

//Single listing -- should be on bottom of all listing routes 'cause of routing
Route::get('/listings/{listing}', [ListingController::class, 'show']);

//Show register create form for User
Route::get('/register', [UserController::class, 'create'])->middleware('guest');

//Create new user
Route::post('/users', [UserController::class, 'store']);

//Logout user
Route::post('/logout', [UserController::class, 'logout'])->middleware('auth');

//Show login form
Route::get('/login', [UserController::class, 'login'])->middleware('guest');

//Log in user
Route::post('/users/authenticate', [UserController::class, 'authenticate']);
        

// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });

// require __DIR__.'/auth.php';

//Common routes:
//index - show all listings
//show - show single listing
//create - show form to create new listing
//store - store new listing
//edit - show form to edit listing
//update - update listing
//destroy - delete listing