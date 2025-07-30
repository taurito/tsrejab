<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('requisitos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre'); // Ej: Documento Identidad
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('requisitos');
    }
};