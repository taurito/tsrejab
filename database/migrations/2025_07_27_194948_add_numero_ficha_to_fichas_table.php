<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::table('fichas', function (Blueprint $table) {
        $table->integer('numero_ficha')->after('fecha_entrega');
    });
}

public function down()
{
    Schema::table('fichas', function (Blueprint $table) {
        $table->dropColumn('numero_ficha');
    });
}

};
