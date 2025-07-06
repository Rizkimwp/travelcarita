<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
class Jadwal extends Model
{
    //
    protected $table = 'jadwal_keberangkatan';

    protected $fillable = ['id_paket', 'tanggal_berangkat', 'sisa_kuota'];

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