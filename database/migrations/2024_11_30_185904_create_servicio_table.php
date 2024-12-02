<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateServicioTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('servicio', function (Blueprint $table) {
            $table->id();
            $table->string('nombre_servicio');
            $table->timestamps();
        });

        // Insertar servicios predefinidos
        DB::table('servicio')->insert([
            ['nombre_servicio' => 'Compra de Mercancía'],
            ['nombre_servicio' => 'Mantenimiento de Mercancía'],
            ['nombre_servicio' => 'Alquiler'],
            ['nombre_servicio' => 'Mantenimiento Local'],
            ['nombre_servicio' => 'Mantenimiento de IT'],
            ['nombre_servicio' => 'Papelería'],
            ['nombre_servicio' => 'Mobiliario'],
            ['nombre_servicio' => 'Limpieza'],
            ['nombre_servicio' => 'Publicidad'],
            ['nombre_servicio' => 'Administración'],
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('servicio');
    }
}