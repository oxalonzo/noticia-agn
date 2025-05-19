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
        Schema::create('destacadas', function (Blueprint $table) {
            $table->id();
            $table->string('titulo_noticia_portada_destacada');
            $table->string('titulo_noticia_destacada');
            $table->text('descripcion_noticia_destacada');
            $table->string('imagen_noticia_destacada');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');//esto lo que hace es un foreingkey con el user-id pero que cuando el usuario elimine su cuenta se eliminaran sus post tambien
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('destacadas');
    }
};
