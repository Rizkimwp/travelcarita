<?php

namespace App\Models;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;

class Notifikasi extends Model
{
    //
    protected $table = 'notifikasi';

    protected $fillable = ['id_user', 'tipe', 'pesan', 'pesan', 'dibaca'];

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