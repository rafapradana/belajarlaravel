<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class guru extends Model
{
    use HasFactory;
    
    protected $table = 'dataguru';
    protected $primaryKey = 'idguru';
    protected $fillable = ['id','nama', 'mapel']; 

    public function admin() {
        return $this->belongsTo(admin::class, 'id');
    }

    // Relasi hasMany ke kbm
    public function kbm() {
        return $this->hasMany(kbm::class, 'idguru', 'idguru');
    }
}
