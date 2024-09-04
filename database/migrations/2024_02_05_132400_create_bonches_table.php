<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('bonches', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100);
            $table->string('nbloque', 10);
            $table->string('cantidadtallos', 10);
            $table->string('codigobarras', 10);
            $table->string('medida', 10);           
            $table->date('fecha');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bonches');
    }
};
