<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class FasilitasPaket extends Model
{
    //

    protected $table = 'fasilitas_paket_wisata';

    protected $fillable = ['id_paket', 'id_fasilitas'];

    public $incrementing = false;

    protected $keyType = 'string';

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            $model->id = (string) Str::uuid();
        });
    }

    public function paketWisata()
    {
        return $this->belongsTo(PaketWisata::class, 'id_paket');
    }

    public function fasilitas()
    {
        return $this->belongsTo(Fasilitas::class, 'id_fasilitas');
    }
}
