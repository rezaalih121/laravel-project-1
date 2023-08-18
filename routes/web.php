<?php

use App\Http\Controllers\ListingController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Listing;

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



// Show Create Form
Route::get('/listings/create', [ListingController::class , 'create']);

// Store Listing Data
Route::post('/listings', [ListingController::class , 'store']);


// Show Edit Form
Route::get('/listings/{listing}/edit', [ListingController::class , 'edit']);


// Update Single Listing
Route::put('/listings/{listing}', [ListingController::class , 'update']);

// Delete Single Listing
Route::delete('/listings/{listing}', [ListingController::class , 'destroy']);

// Show single listing
Route::get('/listings/{listing}', [ListingController::class , 'show']);



// codes just for learning and reminder


// this could be replaced by the next function laravel automatically will find listing that way

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


