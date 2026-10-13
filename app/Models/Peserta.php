<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Peserta extends Model
{
   use HasFactory;

    protected $fillable = [
    'user_id',
    'skema_id',
    'nm_peserta',
    'jk',
    'almt',
    'no_hp',
    'status',
];

public function user()
{
    return $this->belongsTo(User::class);
}

public function skema()
{
    return $this->belongsTo(Skema::class);
}
   
}
