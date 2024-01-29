<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
    protected $primaryKey = 'id';

    use HasFactory;
    protected $fillable = [
        'name',
        'price',
        'photo',
       

        
    ];
    public $timestamps = false;  
    protected $table = 'offers';  
}