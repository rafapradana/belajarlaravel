<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Siswa extends Model
{
    use HasFactory;
    
    protected $primaryKey = 'idsiswa';
    protected $table = 'datasiswa';
    protected $fillable = ['id','nama', 'bb', 'tb'];

    public function admin() {
        return $this->belongsTo(Admin::class, 'id');
    }
}