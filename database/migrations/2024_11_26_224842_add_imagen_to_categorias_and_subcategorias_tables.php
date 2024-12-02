<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddImagenToCategoriasAndSubcategoriasTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('categoria', function (Blueprint $table) {
            $table->string('imagen')->nullable()->after('nombre_categoria');
        });

        Schema::table('subcategoria', function (Blueprint $table) {
            $table->string('imagen')->nullable()->after('nombre_subcategoria');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('categoria', function (Blueprint $table) {
            $table->dropColumn('imagen');
        });

        Schema::table('subcategoria', function (Blueprint $table) {
            $table->dropColumn('imagen');
        });
    }
}
