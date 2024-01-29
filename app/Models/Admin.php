<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable;

class Admin extends Model implements Authenticatable
{
    protected $table = 'admins';

    protected $fillable = [
        'name', 'email', 'password',
    ];

    use HasFactory;

    // Implement the missing methods required by Authenticatable interface

    public function getAuthIdentifierName()
    {
        return 'id'; // Replace with the actual column name used as the unique identifier for the admin user
    }

    public function getAuthIdentifier()
    {
        return $this->getKey();
    }

    public function getAuthPassword()
    {
        return $this->password;
    }

    public function getRememberToken()
    {
        return $this->remember_token;
    }

    public function setRememberToken($value)
    {
        $this->remember_token = $value;
    }

    public function getRememberTokenName()
    {
        return 'remember_token';
    }
}