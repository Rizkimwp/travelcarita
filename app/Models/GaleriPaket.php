<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
class GaleriPaket extends Model
{
    //
    protected $table = 'galery_paket';

    protected $fillable = ['id_paket', 'tipe', 'url_media'];

    public $incrementing = false;

    protected $keyType = 'string';

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            $model->id = (string) Str::uuid();
        });
    }

    public function paket()
    {
        return $this->belongsTo(PaketWisata::class, 'id_paket');
    }
}