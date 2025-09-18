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
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            $table->string('rut_empresa', 12)->unique();
            $table->string('rubro', 150);
            $table->string('razon_social', 255);
            $table->string('telefono', 20);
            $table->text('direccion');
            $table->string('nombre_contacto', 200);
            $table->string('email_contacto', 100);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clients');
    }
};
