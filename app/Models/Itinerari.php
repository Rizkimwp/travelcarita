<?php

namespace App\Models;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;

class Itinerari extends Model
{
    //
    protected $table = 'itinerary';

    protected $fillable = ['id_paket', 'hari_ke', 'kegiatan', 'waktu'];

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