<?php 
namespace App;

use Illuminate\Database\Eloquent\Model;

class Subcategoria extends Model
{
    protected $table = 'subcategoria'; // Define explícitamente el nombre de la tabla
    protected $fillable = ['nombre_subcategoria','imagen','estado'];

    public function productos()
    {
        return $this->hasMany(Producto::class);
    }
}
