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
        Schema::create('personel', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('pangkat');
            $table->string('jabatan');
            $table->string('unit');
            $table->string('foto')->nullable();
            $table->string('nip')->unique();
            $table->string('no_telepon')->nullable();
            $table->text('catatan')->nullable();
            $table->enum('status', ['aktif', 'nonaktif'])->default('aktif');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('personel');
    }
};
