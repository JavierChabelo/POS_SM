<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Compra extends Model
{
    protected $table = 'compra'; // Especifica el nombre de la tabla si no sigue la convención de Laravel.

    protected $fillable = ['proveedor_id','fecha','estado','monto'];



   // Relación N:1 con Proveedor
   public function proveedor()
   {
       return $this->belongsTo(Proveedor::class);
   }

    // Relación 1:N con DetalleCompra
    public function detalleCompras()
    {
        return $this->hasMany(DetalleCompra::class,'compra_id');
    }
    

    /**
    * public function cliente()
    *{
    *    return $this->belongsTo("App\Cliente", "id_cliente");
    *}
     */

}
