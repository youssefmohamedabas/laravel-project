<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    protected $fillable = [
        'name',
        'title',
        'hospital_id',
        'gender',
       
    ];
    use HasFactory;
    public function Hospital(){
        return $this->belongsTo('App\models\Hospital','hospital_id','id');
    }
}