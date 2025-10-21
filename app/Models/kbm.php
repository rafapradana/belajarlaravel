<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class kbm extends Model
{
    use HasFactory;
    protected $table = 'datakbm';
    protected $primaryKey = 'idkbm';
    
    protected $fillable = [
        'idguru',
        'idwalas',
        'hari',
        'mulai',
        'selesai'
    ];

    // Relasi many-to-many dengan guru
    public function guru()
    {
        return $this->belongsTo(guru::class, 'idguru', 'idguru');
    }

    // Relasi many-to-many dengan walas
    public function walas()
    {
        return $this->belongsTo(walas::class, 'idwalas', 'idwalas');
    }
}
