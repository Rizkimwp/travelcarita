<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Testimoni extends Model
{
    //
    protected $table = 'testimoni';

    protected $fillable = ['id_user', 'id_paket', 'rating', 'komentar'];

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

    public function paketWisata()
    {
        return $this->belongsTo(PaketWisata::class, 'id_paket');
    }
}
