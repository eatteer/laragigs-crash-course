<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ListingsController extends Controller
{
    public function index(Request $request)
    {
        $tag = $request->tag;
        $search = $request->search;
        $listings = Listing::latest()
            ->filter([
                'tag' => $tag,
                'search' => $search
            ])
            ->paginate(6);
        return view('listings.index', ['listings' => $listings]);
    }

    public function show(Listing $listing)
    {
        return view('listings.show', ['listing' => $listing]);
    }

    public function create()
    {
        return view('listings.create');
    }

    public function store(Request $request)
    {
        $validatedFields = $request->validate([
            'company' => 'required|unique:listings',
            'title' => 'required',
            'location' => 'required',
            'email' => 'required|email',
            'website' => 'required|url',
            'tags' => 'required',
            'description' => 'required'
        ]);

        if ($request->hasFile('logo')) {
            $validatedFields['logo'] = $request->file('logo')
                ->store('logos', 'public');
        }

        $authenticatedUser = Auth::user();
        $validatedFields['user_id'] = $authenticatedUser->id;

        Listing::create($validatedFields);

        return redirect('/')
            ->with('listingStatusMessage', 'Listing created successfully');
    }

    public function edit(Listing $listing)
    {
        return view('listings.edit', ['listing' => $listing]);
    }

    public function update(Request $request, Listing $listing)
    {
        if ($listing->user_id != auth()->id()) {
            abort('403', 'Unauthorized');
        }

        $validatedFields = $request->validate([
            'company' => 'required',
            'title' => 'required',
            'location' => 'required',
            'email' => 'required|email',
            'website' => 'required|url',
            'tags' => 'required',
            'description' => 'required'
        ]);

        if ($request->hasFile('logo')) {
            $validatedFields['logo'] = $request->file('logo')
                ->store('logos', 'public');
        }

        $listing->update($validatedFields);

        return redirect("/listings/$listing->id")
            ->with('listingStatusMessage', 'Listing update successfully');
    }

    public function destroy(Listing $listing)
    {
        if ($listing->user_id != auth()->id()) {
            abort('403', 'Unauthorized');
        }

        $listing->delete();
        return redirect('/')
            ->with('listingStatusMessage', 'Listing deleted successfully');
    }

    public function manage()
    {
        $listings = auth()->user()->listings()->get();
        return view('listings.manage', ['listings' => $listings]);
    }
}
