<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Detail;



class Absensi extends Model
{
    use HasFactory;
    protected $table = 'absensis';

    protected $primaryKey = 'id_absensi';

    public $timestamps = true;

    protected $fillable = [
        'id_jabatan',
        'kehadiran_absen',
        'id', 
        'tanggal_absen',
        'id_detail'
    ];


    
       
    // Relasi ke tabel users
    public function jabatan() {
        return $this->belongsTo(Jabatan::class, 'id_jabatan', 'id_jabatan');
    }
    
    public function user() {
        return $this->belongsTo(User::class, 'id', 'id');
    }
    public function detail()
    {
        return $this->belongsTo(Detail::class, 'id_detail');
    }
    
    
}
