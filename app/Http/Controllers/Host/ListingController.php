<?php

namespace App\Http\Controllers\Host;

use App\Http\Controllers\Controller;
use App\Models\Amenity;
use App\Models\Listing;
use App\Models\Rule;
use Illuminate\Http\Request;

class ListingController extends Controller
{
    public function index(){
        $listings = Listing::with('listingImages')
            ->where('host_id', auth()->user()->host->id)
            ->get();

        return view('host.listings', compact('listings'));
    }

    public function create(){

        $amenities = Amenity::all();

        /*Rules*/
        $genderRules = Rule::where('category', 'gender')->get();
        $tenantRules = Rule::where('category', 'tenant')->get();
        $petRules = Rule::where('category', 'pet')->get();
        $curfewRules = Rule::where('category', 'curfew')->get();
        $smokingRules = Rule::where('category', 'smoking')->get();
        $guestRules = Rule::where('category', 'guest')->get();
        return view('host.create', compact('amenities', 'genderRules', 'tenantRules', 'petRules', 'curfewRules', 'smokingRules', 'guestRules'));
    }

    public function store(Request $request){
        $listingAttributes = $request->validate([
            /*String*/
            'title' => ['required', 'string', 'min:8', 'max:50'],
            'address' => ['required', 'string', 'min:10', 'max:100'],
            'description' => ['required', 'string', 'min:20', 'max:2000'],
            /*Numbers*/
            'slot' => ['required', 'integer', 'min:1', 'max:15'],
            'rent_cost' => ['required', 'numeric', 'min:1'],
            'water_supply_cost' => ['nullable', 'numeric', 'min:1'],
            'electricity_cost' => ['nullable', 'numeric', 'min:1'],
            /*Amenities*/
            'amenities' => ['required', 'array'],
            'amenities.*' => ['integer', 'exists:amenities,id'],
            /*Photos*/
            'cover_photo' => ['required', 'image', 'mimes:jpg,jpeg,png', 'max:5120'],
            'images' => ['nullable', 'array', 'max:2'],
            'images.*' => ['image', 'mimes:jpg,jpeg,png', 'max:5120'],
            /*Rules & Restriction*/
            'gender_rule' => ['required', 'integer', 'exists:rules,id'],
            'tenant_rule' => ['required', 'integer', 'exists:rules,id'],
            'guest_rule' => ['required', 'integer', 'exists:rules,id'],
            'pet_rule' => ['required', 'integer', 'exists:rules,id'],
            'curfew_rule' => ['required', 'integer', 'exists:rules,id'],
            'smoking_rule' => ['required', 'integer', 'exists:rules,id'],
        ]);

        $listing = Listing::create([
            'host_id' => auth()->user()->host->id,
            'status' => 'available',
            'title' => $listingAttributes['title'],
            'address' => $listingAttributes['address'],
            'description' => $listingAttributes['description'],
            'slot' => $listingAttributes['slot'],
            'rent_cost' => $listingAttributes['rent_cost'],
            'water_supply_cost' => $listingAttributes['water_supply_cost'],
            'electricity_cost' => $listingAttributes['electricity_cost'],

        ]);

        /*Store in pivot tables: amenity_listing, listing_rule*/
        $listing->amenities()->attach($listingAttributes['amenities']);
        $listing->rules()->attach([
            $listingAttributes['gender_rule'],
            $listingAttributes['tenant_rule'],
            $listingAttributes['guest_rule'],
            $listingAttributes['pet_rule'],
            $listingAttributes['curfew_rule'],
            $listingAttributes['smoking_rule'],
        ]);

        /*store files in laravel file storage*/
        $coverPath = $request->file('cover_photo')->store('listing-images', 'public');

        /*Store in DB*/
        $listing->listingImages()->create([
           'image_path' => $coverPath,
           'is_cover' => true
        ]);


        // Additional photos (both are under images[])
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $listing->listingImages()->create([
                    'image_path' => $image->store('listing-images', 'public'),
                    'is_cover' => false
                ]);
            }
        }



        return redirect()->route('host.listings');

    }
}
