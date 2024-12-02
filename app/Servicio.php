<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Servicio extends Model
{
    protected $table = 'servicio'; // Definir explícitamente el nombre de la tabla

    protected $fillable = ['nombre_servicio'];

    // Relación 1:N con Proveedores
    public function proveedores()
    {
        return $this->hasMany(Proveedor::class);
    }
}
