<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
class Maps extends Model
{
    //
     //
     protected $table = 'maps';

     protected $fillable = ['id_paket', 'path'];

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