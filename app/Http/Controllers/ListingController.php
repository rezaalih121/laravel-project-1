<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ListingController extends Controller
{

    // Common Resource Routes:
    // index - Show all listings
    // show - Show single listing
    // create - Show form to create new listing
    // store - Store new listing
    // edit - Show form to edit listing
    // update - Update listing
    // destroy - Delete listing

    // Show all listings
    public function index()
    {
        // public function index(Request $request){
        //     dd($request->tag);
        //     dd(request()->tag);
        //     dd(request('tag'));

        // we need to create a function called scopeFilter in Listing model to handle filtering by tags

        // return view('listings.index', [
        //     'listings'=> Listing::latest()->filter(request((['tag' , 'search'])))->get()
        // ]);

        // this is how you make pagination
        // look what it will returns
        // dd(Listing::latest()->filter(request((['tag' , 'search'])))->paginate(2));
        // to add page number list just add this to a dive at the end of index view : {{$listings->links()}}
        // you can use simplePaginate to have only previous and next page button

        // to customize pagination styles or any other features you use this command to first publish it to access the codes and customize it
        // php artisan vendor:publish
        // you need to set it in AppServiceProvider files look here : https://laravel.com/docs/10.x/pagination

        return view('listings.index', [
            'listings' => Listing::latest()->filter(request((['tag', 'search'])))->paginate(7),
        ]);
    }

    // Show single listing
    public function show(Listing $listing)
    {
        return view('listings.show', [
            'listing' => $listing,
        ]);
    }

    // Show Create Form
    public function create()
    {
        return view('listings.create');
    }

    // Store Listing Data
    public function store(Request $request)
    {
        //dd($request->all());

        //dd($request->file('logo'));

        $formFields = $request->validate([
            "title" => 'required',
            "company" => ['required', Rule::unique('listings', 'company')],
            "location" => 'required',
            "website" => 'required',
            "tags" => 'required',
            "description" => 'required',
            "email" => ['required', 'email'],
        ]);

        // to upload file use this but do not forget to add
        // to $fillable list in model
        // also to access public images we need to run this command : php artisan storage:link
        if ($request->hasFile('logo')) {
            $formFields['logo'] = $request->file('logo')->store('logos', 'public');
        }
        // adding user_id to created Listing by current user
        $formFields['user_id'] = auth()->id();

        // for protection reasons in Laravel we need to add a $fillable variable in the Listing model containing the list of properties which are allowed to be inserted
        // but we also could just disable this protection option in the Provider/AppServiceProvider.php file and in boot() function add this
        // Model::unguard();

        Listing::create($formFields);
        // to show a message we need to create a component to for it
        return redirect('/')->with('message', 'Listing created successfully!!!');

    }

    // Show Edit Form
    public function edit(Listing $listing)
    {
        return view('listings.edit', ['listing' => $listing]);
    }

    // Update Listing Data
    public function update(Request $request, Listing $listing)
    {
        //dd($request->all());

        //dd($request->file('logo'));

        // Make sure logged in user is owner

        if($listing->user_id != auth()->id()){
            abort(403, 'Unauthorized Action');
        }

        $formFields = $request->validate([
            "title" => 'required',
            "company" => ['required'],
            "location" => 'required',
            "website" => 'required',
            "tags" => 'required',
            "description" => 'required',
            "email" => ['required', 'email'],
        ]);

        if ($request->hasFile('logo')) {
            $formFields['logo'] = $request->file('logo')->store('logos', 'public');
        }


        $listing->update($formFields);
        // to show a message we need to create a component to for it
        return back()->with('message', 'Listing updated successfully!!!');

    }

    // Delete Listing
    public function destroy(Listing $listing){

         // Make sure logged in user is owner

         if($listing->user_id != auth()->id()){
            abort(403, 'Unauthorized Action');
        }
        
        $listing->delete();
        return redirect('/listings/manage')->with('message', 'Listing deleted successfully');

    }

    // Manage Listing
    public function manage(){
        return view('listings.manage' , ['listings' => auth()->user()->listings()->get() ]);
    }

}
