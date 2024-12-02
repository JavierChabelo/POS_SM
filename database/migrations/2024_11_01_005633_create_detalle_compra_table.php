<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetalleCompraTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detalle_compra', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('compra_id');
            $table->unsignedBigInteger('productos_id');
            $table->integer('cantidad');
            $table->decimal('precio_venta', 10, 2);
            $table->decimal('costo_compra', 10, 2);
            $table->decimal('total', 10, 2);
            $table->timestamps();

            // Agregar claves foráneas productos y compra
            $table->foreign('productos_id')
            ->references('id')
            ->on('productos')
            ->onDelete('cascade')
            ->onUpdate('cascade');

            // Agregar claves foráneas productos y compra
            $table->foreign('compra_id')
            ->references('id')
            ->on('compra')
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
        Schema::dropIfExists('detalle_compra');
    }
}
