<?php

use App\Models\Listing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ListingController;

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
// Common Resource Routes:
    // index - Show all listings
    // show - Show single listing
    // create - Show form to create new listing
    // store - Store new listing
    // edit - Show form to edit listing
    // update - Update listing
    // destroy - Delete listing  


        // Show all listings
Route::get('/', [ListingController::class , 'index']);


// here for prevent access to pages for not authenticated user just add ->middleware('auth'); 
// and for not letting logged in user access to register page we just add ->middleware('guest');

// Show Create Form
Route::get('/listings/create', [ListingController::class , 'create'])->middleware('auth');

// Store Listing Data
Route::post('/listings', [ListingController::class , 'store'])->middleware('auth');;

// Manage Listing
Route::get('/listings/manage', [ListingController::class , 'manage'])->middleware('auth');

// Store Listing Data
//Route::post('/listings', [ListingController::class , 'store'])->middleware('auth');

// Show Edit Form
Route::get('/listings/{listing}/edit', [ListingController::class , 'edit'])->middleware('auth');;


// Update Single Listing
Route::put('/listings/{listing}', [ListingController::class , 'update'])->middleware('auth');;

// Delete Single Listing
Route::delete('/listings/{listing}', [ListingController::class , 'destroy'])->middleware('auth');;



// Show single listing
Route::get('/listings/{listing}', [ListingController::class , 'show']);


// Show register/create form
Route::get('/register', [UserController::class , 'create'])->middleware('guest');

// Create New User
Route::post('/users', [UserController::class , 'store'])->middleware('guest');

// Log User Out
Route::post('/logout', [UserController::class , 'logout'])->middleware('auth');

// Show Login Form
// in middleware folder Authentication you can specify where to redirect user by giving a name to the route you want to be redirected ->name('login')
// also to redirect already logged in users we need to specify home redirect address in Providers/RouteServiceProvider.php in our case is just '/'
Route::get('/login', [UserController::class , 'login'])->name('login')->middleware('guest');

// Login  User
Route::post('/users/login', [UserController::class , 'authenticate']);




// codes just for learning and reminder


// this could be replaced by the next function Laravel automatically will find listing that way

// Route::get('/listings/{id}', function ($id) {
    
//     $listing = Listing::find($id);

//     if($listing){
//         return view('listing', [
//             'listing'=> Listing::find($id)
//         ]);
//     }
//     else{
//         abort('404');
//     }
    
    
// });

// Route::get('/listings/{listing}', function (Listing $listing) {

// });
// Route::get('/hello',function(){
//     return response('<h1>Hello World !! </h1>',200)
//     //->header('Content-Type' , 'text/plane')
//     ->header('foo','bar');
// });

// Route::get('/post/{id}' , function($id){

//     //dd($id);
//     //ddd($id);
//     return response('Post ' . $id);
// })->where('id', '[0-9]+');

// Route::get('/search/',function(Request $request){

//     return $request->name . ' ' . $request->city;
    
// });


