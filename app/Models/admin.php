<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Admin extends Model
{
    //

    protected $table = 'dataadmin'; 
    protected $fillable = [
        'username',
        'password',
        'role'
    ];
    use HasFactory;

    
}