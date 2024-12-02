<?php
 ?>
<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    //protected $fillable = ["codigo_barras", "descripcion", "precio_compra", "precio_venta", "existencia",
    //];

    protected $fillable = ['categoria_id','subcategoria_id','nombre','precio_compra',
                           'precio_venta','existencia','imagen_url','comentario','estado'];

    public function categoria()
    {
        return $this->belongsTo(Categoria::class);
    }

    public function subcategoria()
    {
        return $this->belongsTo(Subcategoria::class);
    }

}
