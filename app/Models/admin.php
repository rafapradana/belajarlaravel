<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Admin extends Model
{
    //
    protected $primaryKey = 'id';
    protected $table = 'dataadmin'; 
    protected $fillable = [
        'username',
        'password',
        'role'
    ];
    use HasFactory;

    public function siswa() {
    return $this->hasOne(siswa::class, 'id');
    }

    public function guru() {
    return $this->hasOne(guru::class, 'id');
    }
}