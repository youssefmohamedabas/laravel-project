<?php

namespace App\Http\Controllers;

use App\Events\VideoViewer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View; 
use App\Models\Offer;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\OfferRequest;
use App\Models\video;

class CrudCntroller extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        
    }
    public function getOffers(){
$offers= Offer::select('id','name','price')->get();
return view('offers.all',compact('offers'));
    }
    /*public function store(){
        Offer::create(['name'=>'hhhhh2',
        'price'=>'100$',
    ]);
    }*/
    public function create(){
    
       return view('offers.offerpage');
     
    }
    public function edit($offerid){
       //Offer::findOrFail($offerid);
       $offer=Offer::find($offerid);
       if(!$offer){
        return redirect()->back();
       }
     $o=Offer::select('id','name','price')->find($offerid);
     return view('offers.edit',compact('o'));
    }

    public function store(Request $req){
        $file_extension=$req->photo->getclientOriginalExtension();
        $file_name=time().'.'.$file_extension;
        $path='offers/images';
        $req->photo->move($path,$file_name);
        $messages=['name.required'=>__('messages.offer_name_required'),
        'name.unique'=>__('messages.offer_name_unique'),
        'name.max'=>__('messages.offer_name_max'),
        'price.required'=>__('messages.offer_price_required'),
        'price.numeric'=>__('messages.offer_price_numeric'),];
    $validator=Validator::make($req->all()
    ,['name'=>'required|max:50|unique:offers,name',
    'price'=>'required|numeric',],$messages
    );
    if ($validator->fails()){
        return redirect()->back()->withErrors($validator)->withInput($req->all());
    }
        Offer::create(['name'=>$req->name
        ,'price'=>$req->price,'photo'=>$file_name,
    ]);
    return redirect()->route('all')->with(['success' => 'Successfully logged in']);

     }
     public function updateoffer(Request $req, $offerid)
{
    $req->validate([
        'name' => 'required|max:50|unique:offers,name',
        'price' => 'required|numeric',
    ]);

    $offer = Offer::find($offerid);
    if (!$offer) {
        return redirect()->back();
    }

    $offer->update($req->all());
    

    return redirect()->route('all')->with(['success' => 'Successfully saved']);
   
}
public function getvideo(){
   $video=video::first();
   event(new VideoViewer($video));
    return view('Video')->with('video',$video);
}

public function delete ($offerid){
$offer=Offer::find($offerid);

if(!$offer)
{
    return redirect()->back()->with(['error'=>'the offer cannot delete']);
}
$offer->delete();
return redirect()->route('offerdelete',$offerid)->with(['success' => 'Successfully deleted']);
   
}
}