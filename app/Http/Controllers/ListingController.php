<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Http\Request;

class ListingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('listings.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $form_fields = $request->validate([
            'company' => 'required|unique:listings,company',
            'title' => 'required|string',
            'location' => 'required|string',
            'email' => 'required|email',
            'website' => 'required|url',
            'tags' => 'required|string',
            'description' => 'required',
        ]);

        if ($request->hasFile('logo')) {
            $form_fields['logo'] = $request->file('logo')->store('logos', 'public');
        }
        $form_fields['user_id'] = auth()->id();

        Listing::create($form_fields);

        return redirect('/')->with('message', 'Listing created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Listing $listing)
    {
        return view('listings.show', ['listing' => $listing]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Listing $listing)
    {
        return view('listings.edit', ['listing' => $listing]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Listing $listing)
    {
        if ($listing->user_id != auth()->id()) {
            abort(403, 'Unauthorized Action');
        }

        $form_fields = $request->validate([
            'company' => 'required',
            'title' => 'required|string',
            'location' => 'required|string',
            'email' => 'required|email',
            'website' => 'required|url',
            'tags' => 'required|string',
            'description' => 'required',
        ]);

        if ($request->hasFile('logo')) {
            $form_fields['logo'] = $request->file('logo')->store('logos', 'public');
        }

        $listing->update($form_fields);

        return redirect('/listings/' . $listing->id)->with('message', 'Listing updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Listing $listing)
    {
        if ($listing->user_id != auth()->id()) {
            abort(403, 'Unauthorized Action');
        }

        $listing->delete();
        return redirect('/')->with('message', 'Listing deleted successfully');
    }
}