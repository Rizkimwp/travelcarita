<?php

namespace App\Models;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;

class Testimoni extends Model
{
    //
    protected $table = 'testimoni';

    protected $fillable = ['id_user', 'id_paket', 'rating', 'komentar',];

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