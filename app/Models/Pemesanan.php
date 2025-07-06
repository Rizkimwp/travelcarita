<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Pemesanan extends Model
{
    //
    protected $table = 'pemesanan';

    protected $fillable = ['id_user', 'id_paket', 'jumlah_peserta', 'id_layanan', 'total_harga', 'status_pembayaran'];

    public $incrementing = false;

    protected $keyType = 'string';

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            $model->id = (string) Str::uuid();
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    // ✅ Relasi ke Paket Wisata
    public function paket()
    {
        return $this->belongsTo(PaketWisata::class, 'id_paket');
    }

    // ✅ Relasi ke Layanan (opsional, bisa null)
    public function layanan()
    {
        return $this->belongsTo(Layanan::class, 'id_layanan');
    }
}
