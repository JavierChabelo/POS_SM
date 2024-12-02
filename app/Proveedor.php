<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Proveedor extends Model
{
    protected $table = 'proveedor';
    
    protected $fillable = ['nombre','telefono','calle','colonia','nombre_contacto',
                           'apellido_contacto','comentarios','estado','servicio_id'];

    // Relación N:1 con Servicio
    public function servicio()
    {
        return $this->belongsTo(Servicio::class, 'servicio_id');
    }
     // Relación 1:N con Compra
     public function compras()
     {
         return $this->hasMany(Compra::class);
     }
}
