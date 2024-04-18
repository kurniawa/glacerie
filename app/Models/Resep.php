<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Resep extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    function resep_bahans() {
        return $this->hasMany(ResepBahan::class, 'resep_id', 'id');
    }

    function bahans() {
        return $this->belongsToMany(Bahan::class, 'resep_bahans');
    }
}
