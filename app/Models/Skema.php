<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Skema extends Model
{
    use HasFactory;

    protected $fillable = ['kd_skema', 'nm_skema', 'jenis'];

    public function pesertas()
    {
        return $this->hasMany(Peserta::class);
    }
}
