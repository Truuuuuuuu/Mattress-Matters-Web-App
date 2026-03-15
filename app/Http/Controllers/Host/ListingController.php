<?php

namespace App\Http\Controllers\Host;

use App\Http\Controllers\Controller;
use App\Models\Amenity;
use App\Models\Listing;
use App\Models\ListingImage;
use App\Models\Rule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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

    public function show(Listing $listing)
    {
        $listing = Listing::with(['listingImages','amenities', 'rules'])->findOrFail($listing->id);

        return view('host.show', compact('listing'));
    }

    public function edit(Listing $listing)
    {
        $listing = Listing::with(['listingImages','amenities', 'rules'])->findOrFail($listing->id);
        $amenities = Amenity::all();
        $listingAmenityIds = $listing->amenities->pluck('id')->toArray(); /*selected in target listing*/
        $listingRuleIds = $listing->rules->pluck('id')->toArray();

        /*Rules*/
        $genderRules = Rule::where('category', 'gender')->get();
        $tenantRules = Rule::where('category', 'tenant')->get();
        $petRules = Rule::where('category', 'pet')->get();
        $curfewRules = Rule::where('category', 'curfew')->get();
        $smokingRules = Rule::where('category', 'smoking')->get();
        $guestRules = Rule::where('category', 'guest')->get();


        return view('host.edit', compact('listing',
            'amenities', 'listingAmenityIds',
            'listingRuleIds', 'genderRules', 'tenantRules', 'petRules', 'curfewRules',
            'smokingRules', 'guestRules'));
    }

    public function update(Request $request, Listing $listing)
    {
        /*Validate*/
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
            'cover_photo' => ['nullable', 'image', 'mimes:jpg,jpeg,png', 'max:5120'],
            'image_photo1' => ['nullable', 'image', 'mimes:jpg,jpeg,png', 'max:5120'],
            'image_photo2' => ['nullable', 'image', 'mimes:jpg,jpeg,png', 'max:5120'],
            /*Rules & Restriction*/
            'gender_rule' => ['required', 'integer', 'exists:rules,id'],
            'tenant_rule' => ['required', 'integer', 'exists:rules,id'],
            'guest_rule' => ['required', 'integer', 'exists:rules,id'],
            'pet_rule' => ['required', 'integer', 'exists:rules,id'],
            'curfew_rule' => ['required', 'integer', 'exists:rules,id'],
            'smoking_rule' => ['required', 'integer', 'exists:rules,id'],
        ]);



        $listing->update([
            'title' => $listingAttributes['title'],
            'address' => $listingAttributes['address'],
            'description' => $listingAttributes['description'],
            'slot'              => $listingAttributes['slot'],
            'rent_cost'         => $listingAttributes['rent_cost'],
            'water_supply_cost' => $listingAttributes['water_supply_cost'],
            'electricity_cost'  => $listingAttributes['electricity_cost'],
        ]);

        /*Sync pivot tables — sync() replaces old with new*/
        $listing->amenities()->sync($listingAttributes['amenities']);
        $listing->rules()->sync([
            $listingAttributes['gender_rule'],
            $listingAttributes['tenant_rule'],
            $listingAttributes['guest_rule'],
            $listingAttributes['pet_rule'],
            $listingAttributes['curfew_rule'],
            $listingAttributes['smoking_rule'],
        ]);

        /*makes sure the cover is not null*/
        if ($request->remove_cover == '1' && !$request->hasFile('cover_photo')) {
            return back()->withErrors(['cover_photo' => 'Cover photo is required.'])->withInput();
        }

        /*Handle cover photo*/
        if ($request->hasFile('cover_photo')) {
            // Delete old cover from storage
            $oldCover = $listing->listingImages()->where('is_cover', true)->first();
            if ($oldCover) {
                Storage::disk('public')->delete($oldCover->image_path);
                $oldCover->delete();
            }
            // Store new cover
            $listing->listingImages()->create([
                'image_path' => $request->file('cover_photo')->store('listing-images', 'public'),
                'is_cover'   => true,
            ]);
        } elseif ($request->remove_cover == '1') {
            $oldCover = $listing->listingImages()->where('is_cover', true)->first();
            if ($oldCover) {
                Storage::disk('public')->delete($oldCover->image_path);
                $oldCover->delete();
            }
        }
        // Handle photo1
        if ($request->hasFile('image_photo1')) {
            // Delete old if exists (replacing)
            if ($request->existing_photo1_id) {
                $old = ListingImage::find($request->existing_photo1_id);
                if ($old) {
                    Storage::disk('public')->delete($old->image_path);
                    $old->delete();
                }
            }
            // Store new — works for both adding new and replacing
            $listing->listingImages()->create([
                'image_path' => $request->file('image_photo1')->store('listing-images', 'public'),
                'is_cover'   => false,
            ]);
        } elseif ($request->remove_photo1 == '1' && $request->existing_photo1_id) {
            $old = ListingImage::find($request->existing_photo1_id);
            if ($old) {
                Storage::disk('public')->delete($old->image_path);
                $old->delete();
            }
        }

        // Handle photo2
        if ($request->hasFile('image_photo2')) {
            if ($request->existing_photo2_id) {
                $old = ListingImage::find($request->existing_photo2_id);
                if ($old) {
                    Storage::disk('public')->delete($old->image_path);
                    $old->delete();
                }
            }
            $listing->listingImages()->create([
                'image_path' => $request->file('image_photo2')->store('listing-images', 'public'),
                'is_cover'   => false,
            ]);
        } elseif ($request->remove_photo2 == '1' && $request->existing_photo2_id) {
            $old = ListingImage::find($request->existing_photo2_id);
            if ($old) {
                Storage::disk('public')->delete($old->image_path);
                $old->delete();
            }
        }

        return redirect()->route('host.show', $listing)->with('success', 'Listing updated successfully.');
    }

    public function destroy(Listing $listing)
    {

        $listing->delete();

        return redirect(route('host.listings'))->with('success', 'Listing deleted successfully.');
    }
}
