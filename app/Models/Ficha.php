<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ficha extends Model
{
    use HasFactory;

   protected $fillable = [
    'persona_id',
    'fecha_reserva',
    'fecha_entrega',
    'servicio_id',
    'estado_id'
];


    public function persona()
    {
        return $this->belongsTo(Persona::class);
    }

    public function servicio()
    {
        return $this->belongsTo(Servicio::class);
    }

    public function estado()
    {
        return $this->belongsTo(Estado::class);
    }

    public function requisitos()
    {
        return $this->belongsToMany(Requisito::class, 'ficha_requisito')
                    ->withPivot('cumplido')
                    ->withTimestamps();
    }
}