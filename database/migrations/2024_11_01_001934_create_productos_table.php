<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('productos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('categoria_id'); // Columna de llave foránea para categoría
            $table->unsignedBigInteger('subcategoria_id'); // Columna de llave foránea para subcategoría
            //$table->string("codigo_barras");
            $table->string("nombre");
            $table->decimal("precio_compra", 9, 2);
            $table->decimal("precio_venta", 9, 2);
            $table->integer("existencia");
            $table->string('imagen_url')->nullable(); // Columna para la URL de la imagen
            $table->timestamps();

             // Definir las llaves foráneas
             $table->foreign('categoria_id')
             ->references('id')
             ->on('categoria')
             ->onDelete('cascade')
             ->onUpdate('cascade');

            $table->foreign('subcategoria_id')
             ->references('id')
             ->on('subcategoria')
             ->onDelete('cascade')
             ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('productos', function (Blueprint $table) {
            // Eliminar las llaves foráneas antes de eliminar la tabla
            $table->dropForeign(['categoria_id']);
            $table->dropForeign(['subcategoria_id']);
        });

        Schema::dropIfExists('productos');

    }
}
