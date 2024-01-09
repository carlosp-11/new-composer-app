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
        Schema::create('productos_has_almacenes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_producto')->constrained('productos')->onUpdate('cascade')->onDelete('restrict');
            $table->foreignId('id_almacenes')->constrained('almacenes')->onUpdate('cascade')->onDelete('restrict');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('productos_has_almacenes');
    }
};
