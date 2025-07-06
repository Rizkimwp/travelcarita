<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Pembayaran extends Model
{
    //
    protected $table = 'pembayaran';

    protected $fillable = ['id_pemesanan', 'metode', 'jumlah', 'bukti', 'tipe', 'status_verifikasi'];

    public $incrementing = false;

    protected $keyType = 'string';

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            $model->id = (string) Str::uuid();
        });
    }
}
