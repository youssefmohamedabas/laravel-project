<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hospital extends Model
{
    protected $fillable = [
        'name',
        'adress',
     
       
    ];
    use HasFactory;
    public function doctors(){
        return $this->hasMany('App\models\Doctor','hospital_id','id');
    }
}