<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Requisito extends Model
{
    use HasFactory;

    protected $fillable = ['nombre'];

    public function fichas()
    {
        return $this->belongsToMany(Ficha::class, 'ficha_requisito')
                    ->withPivot('cumplido')
                    ->withTimestamps();
    }
}