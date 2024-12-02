<?php 

namespace App;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    protected $table = 'categoria'; // Define explícitamente el nombre de la tabla

    protected $fillable = ['nombre_categoria','imagen','estado'];


    public function productos()
    {
        return $this->hasMany(Producto::class);
    }
}



