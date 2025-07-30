<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('fichas', function (Blueprint $table) {
            $table->id();
            $table->date('fecha_entrega')->nullable();
            $table->foreignId('persona_id')->constrained('personas')->onDelete('cascade');
            $table->foreignId('servicio_id')->constrained('servicios')->onDelete('cascade');
            $table->foreignId('estado_id')->nullable()->constrained('estados')->onDelete('set null');
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('fichas');
    }
};