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
        Schema::table('users', function (Blueprint $table) {
            $table->string('rut', 12)->unique()->after('id');
            $table->string('nombre', 100)->after('rut');
            $table->string('apellido', 100)->after('nombre');
            
            // Modificar email para que tenga un formato específico
            $table->string('email', 100)->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['rut', 'nombre', 'apellido']);
        });
    }
};
