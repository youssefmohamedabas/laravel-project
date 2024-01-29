<?php

namespace App\Http\Controllers;

use App\Models\Offer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class offercontroller extends Controller
{
    public function create()
    {
        return view('ajaxoffer.createoffer');
    }

    public function store(Request $request)
    {
        // Validate the request data
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:50|unique:offers,name',
            'price' => 'required|numeric',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Example for image upload
        ], [
            'name.required' => __('messages.offer_name_required'),
            'name.unique' => __('messages.offer_name_unique'),
            'name.max' => __('messages.offer_name_max'),
            'price.required' => __('messages.offer_price_required'),
            'price.numeric' => __('messages.offer_price_numeric'),
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'errors' => $validator->errors()]);
        }

        // Handle file upload
        if ($request->hasFile('photo')) {
            $file_extension = $request->photo->getClientOriginalExtension();
            $file_name = time() . '.' . $file_extension;
            $path = 'offers/images';
            $request->photo->move($path, $file_name);
        } else {
            $file_name = null; // No photo uploaded
        }

        // Create and save the offer
        $offer = Offer::create([
            'name' => $request->name,
            'price' => $request->price,
            'photo' => $file_name,
        ]);

        if ($offer) {
            return response()->json(['success' => true]);
        } else {
            return response()->json(['success' => false, 'error' => 'Failed to save the offer.']);
        }
    }
    public function getOffers(){
        $offers= Offer::select('id','name','price')->get();
        return view('ajaxoffer.all',compact('offers'));
            }
            public function delete (Request $req){
                $offer=Offer::find($req->id);
                
                
                    
                $offer->delete();
                return response()->json(['success' => true]);
                   
                }
                
                public function edit(Request $req)
                {
                    $o = optional(Offer::select('id', 'name', 'price')->find($req->offerid));
                
                    if ($o === null) {
                        return response()->json(['success' => false]);    // Handle the case where the offer doesn't exist, for example, redirect or show an error message.
                    } else {
                        return view('ajaxoffer.edit')->with('o', $o);
                    }
                }
                public function update(Request $req){
                    $req->validate([
                        'name' => 'required|max:50|unique:offers,name',
                        'price' => 'required|numeric',
                    ]);
                
                    $offer = Offer::find($req->id);
                    if (!$offer) {
                        return response()->json(['success' => false, 'error' => 'Failed to save the offer.']);
                    }
                
                    $offer->update($req->all());
                    
                    return response()->json(['success' => true]);
                  
                }
                
             
} 