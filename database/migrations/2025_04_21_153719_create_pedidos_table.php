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
        Schema::create('pedidos', function (Blueprint $table) {
            $table->id();
            $table->decimal('subtotal',7,2);
            $table->decimal('impuesto',7,2);
            $table->decimal('total',7,2);
            $table->datetime('fechapedido');
            $table->enum('procedencia',["web","app"])->default("app");
            $table->enum('estado',["nuevo","proceso","entregado"])->default("nuevo");
            $table->foreignId('user_id')->references('id')->on('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pedidos');
    }
};
