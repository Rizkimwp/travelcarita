<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class PaketWisata extends Model
{
    //
    protected $table = 'paket_wisata';

    protected $fillable = ['id_jenis_paket', 'harga', 'diskon', 'durasi_hari', 'deskripsi', 'nama_paket'];

    public $incrementing = false;

    protected $keyType = 'string';

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            $model->id = (string) Str::uuid();
        });
    }

    public function galeri()
    {
        return $this->hasMany(GaleriPaket::class, 'id_paket');
    }
    public function jadwal()
    {
        return $this->hasMany(Jadwal::class, 'id_paket');
    }
    public function itinerari()
    {
        return $this->hasMany(Itinerari::class, 'id_paket');
    }
    public function fasilitasPaket()
    {
        return $this->hasMany(FasilitasPaket::class, 'id_paket');
    }
    public function faqs()
    {
        return $this->hasMany(Faqs::class, 'id_paket');
    }
    public function jenisPaket()
    {
        return $this->belongsTo(JenisPaket::class, 'id_jenis_paket');
    }
    public function maps()
    {
        return $this->hasMany(Maps::class, 'id_paket');
    }

}