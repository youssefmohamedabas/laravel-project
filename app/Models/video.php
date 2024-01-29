<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class video extends Model
{
    protected $primaryKey = 'id';

    use HasFactory;
    protected $fillable = [
        'name',
        'viewer',
        
       

        
    ];
    public $timestamps = false;  
    protected $table = 'videos';  
}