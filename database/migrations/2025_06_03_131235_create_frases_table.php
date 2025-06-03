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
        Schema::create('frases', function (Blueprint $table) {
            $table->id();
            $table->text('frase');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');//esto lo que hace es un foreingkey con el user-id pero que cuando el usuario elimine su cuenta se eliminaran sus post tambien
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('frases');
    }
};
