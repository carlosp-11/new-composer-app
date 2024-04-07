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
        Schema::create('productos', function (Blueprint $table) {
            $table->id();
            $table->string('QR', 10)->unique()->nullable();
            $table->string('nombre', 50);
            $table->float('precio', 8, 2);
            $table->string('descripcion', 200);
            $table->enum('status', ['en stock', 'despachado', 'en traslado', 'con incidencia'])->default('en stock');
            //$table->foreignId('almacen')->constrained('almacenes')->onUpdate('cascade')->onDelete('cascade');
        });

        $productos = DB::table('productos')->get();
        foreach ($productos as $producto) {
            DB::table('productos')
                ->where('id', $producto->id)
                ->update(['QR' => Str::random(10)]);
        }
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('productos');
    }
};

/*
$table->foreignId('almacen')
                ->references('id')
                ->on('almacenes')
                ->onDelete('set null');
*/