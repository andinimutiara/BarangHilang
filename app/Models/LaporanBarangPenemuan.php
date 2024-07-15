<?php

namespace App\Models;

use App\Models\User;
use App\Models\StatusProses;
use Spatie\MediaLibrary\HasMedia;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;
use EightyNine\Approvals\Models\ApprovableModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class LaporanBarangPenemuan extends ApprovableModel implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $table = 'laporan_barang_penemuans';

    protected $fillable = [
        'user_id',
        'status_id',
        'category_id', 
        'lokasi_id',
        'nama_barang', 
        'deskripsi_barang', 
        'deskripsi_kronologi', 
        'tanggal_penemuan', 
        'status',
        'proses_id'
    ];
    
    public function user(){
        return $this->belongsTo(User::class,'user_id', 'id');
    }

    public function statusBarang(){
        return $this->belongsTo(StatusBarang::class,'status_id', 'id');
    }

    public function categoryBarang(){
        return $this->belongsTo(CategoryBarang::class,'category_id', 'id');
    }

    public function lokasiKejadian(){
        return $this->belongsTo(LokasiKejadian::class,'lokasi_id', 'id');
    }

    public function statusProses(){
        return $this->belongsTo(StatusProses::class, 'proses_id', 'id');
    }

    // protected static function boot()
    // {
    //     parent::boot();

    //     static::creating(function ($laporan) {
    //         $laporan->user_id = Auth::id();
    //     });
    // }
    
}
