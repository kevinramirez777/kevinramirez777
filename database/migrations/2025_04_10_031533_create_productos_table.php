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
            $table->string('slug',50)->nullable();
            $table->string('nombre',50)->nullable();
            $table->text('descripcion')->nullable();
            $table->string('urlfoto',60)->nullable();
            $table->decimal('precio',7,2)->nullable();
            $table->integer('stock')->default(0,0);
            $table->boolean('publicado')->default(0);
            $table->integer('orden')->default(0);
            $table->integer('visitas')->default(0);
            $table->boolean('portada')->default(0);
            $table->foreignId('categoria_id')->references('id')->on('categorias');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('productos');
    }
};
