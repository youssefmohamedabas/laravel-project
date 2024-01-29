<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Hospital;
use App\Models\Doctor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Auth as FacadesAuth;
use Illuminate\Support\Facades\Hash;

class Custauth extends Controller
{
    public function getHospitalDoctors(){
       // $hos=Hospital::find(1);
      // $doc= $hos->doctors;
       //foreach($doc as $d)
    //  echo $d->name.'<br>';
    $dooc=Doctor::find(4);
    return $dooc->Hospital->name;
    
      
    }
    public function deletehospital($hospital_id){
        $hos=Hospital::find($hospital_id);
        if(!$hos){
            return abort('404');
        }
        $hos->doctors()->delete();
        $hos->delete();
    }
    public function hospitals(){
       $hospitals= Hospital::select('id','name','address')->get();
        return view('doctors.hospitals',compact('hospitals'));
    }
    public function doctors($hospital_id){
        $hos=Hospital::find($hospital_id);
        $doc=$hos->doctors;
        return view('doctors.doctors',compact('doc'));

    }
    public function hospitals_has_doctor(){
      $hos = Hospital::whereHas('doctors')->get();
      return $hos;
    }
    public function hospitals_doesnthave(){
        $hos = Hospital::whereDoesntHave('doctors')->get();
        return $hos;
      }
    public function hospitals_has_male(){
        $hos = Hospital::with('doctors')->whereHas('doctors', function($q){
            $q->where('gender',1);
        })->get();
        return $hos;
      }
    
    public function adalts(){
        return view('customauth.index');
    }
    //
    public function usersite(){
        return view('offers.homepageuser');
    }
    public function admin(){
        return view('offers.homepageforadmin');
    }
    public function adminlog(){
        return view('auth.adminlogin');
    }
    public function adminlogcheck(Request $req)
    {
        if (Auth::guard('admin')->attempt(['email' => $req->email, 'password' => $req->password])) {
            return redirect()->intended('homeadmin');
        }
    
        return back()->withInput($req->only('email'));
    }
    public function adminreg(){
        $admin = new Admin();
$admin->email = 'admin@example.com';
$admin->name = 'admin@example.com';
$admin->password = Hash::make('admin_password'); // Hash the password
$admin->save();
    }
}