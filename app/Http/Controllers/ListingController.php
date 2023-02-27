<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ListingController extends Controller
{
    // Get and show all listings
    public function index() {
        return view('listings.index', [
            'listings' =>  Listing::latest()->filter(request(['tag','search']))->paginate(6)
        ]);
    }

    // Show single listings
    public function show(Listing $listing) {
        return view('listings.show', [
            'listing' => $listing
        ]);
    }

    //Show Create form
    public function create() {
        if(auth()->id()) {
            return view('listings.create');
        }
        return redirect('/login')->with('message','You have to be logged in to post a job.');
    }

    //Store Listing data
    public function store(Request $request) {
        $formFields = $request->validate([
            'title' => 'required',
            'company' => ['required', Rule::unique('listings','company')],
            'location' => 'required',
            'website' => 'required',
            'email' => ['required', 'email'],
            'tags' => 'required',
            'description' => 'required'
        ]);
        
        if($request->hasFile('logo')) {
            $formFields['logo'] = $request->file('logo')->store('logos', 'public');
            // dd($formFields);
        }
        // dd($formFields);

        $formFields['user_id'] = auth()->id();

        Listing::create($formFields);

        //Flash massage ->with
        return redirect('/')->with('message', 'Listing created successfully');
    }

    //Show edit form
    public function edit(Listing $listing) {
        // dd($listing->title);
        return view('listings.edit', ['listing' => $listing]);
    }

    //update Listing data
    public function update(Request $request, Listing $listing) {

        //Make sure logged in user @ owner
        if($listing->user_id != auth()->id()) {
            abort(403,'Unauthorized actin.');
        }

        $formFields = $request->validate([
            'title' => 'required',
            'company' => ['required'],
            'location' => 'required',
            'website' => 'required',
            'email' => ['required', 'email'],
            'tags' => 'required',
            'description' => 'required'
        ]);
        
        if($request->hasFile('logo')) {
            $formFields['logo'] = $request->file('logo')->store('logos', 'public');
        }
        
        $listing->update($formFields);

        //Flash massage ->with
        return back()->with('message', 'Listing updated successfully');
    }

    //Delete listing
    public function destroy(Listing $listing) {
        
        //Make sure logged in user @ owner
        if($listing->user_id != auth()->id()) {
            abort(403,'Unauthorized actin.');
        }

        $listing->delete();
        return redirect('/')->with('message','Listing deleted successfully.');
    }

    //Manage listing
    public function manage() {
        return view('listings.manage', ['listings' => auth()->user()->listings()->get()]);
    }

}
