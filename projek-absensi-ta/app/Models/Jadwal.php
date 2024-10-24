<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jadwal extends Model
{
    use HasFactory;
    
    protected $table = 'jadwal';

    protected $fillable = [
        'jadwal_hadir',
        'jadwal_pulang',
        'tanggal_jadwal',
        'id_jabatan',
    ];

    // Relasi ke model Jabatan 
    public function jabatan()
    {
        return $this->belongsTo(Jabatan::class, 'id_jabatan');
    }
    

}
