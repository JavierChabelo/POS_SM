<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompraTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('compra', function (Blueprint $table) {
            $table->id();
            $table->char('numero_compra', 10);
            $table->unsignedBigInteger('proveedor_id'); // Llave foránea para el proveedor
            $table->date('fecha'); // Fecha de la compra
            $table->timestamps();

            // Llave foránea de proveedor
            $table->foreign('proveedor_id')
                  ->references('id')
                  ->on('proveedor')
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
        Schema::dropIfExists('compra');
    }
}
