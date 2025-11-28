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
        Schema::create('jadwal_piket', function (Blueprint $table) {
            $table->id();
            $table->foreignId('personel_id')->constrained('personel')->onDelete('cascade');
            $table->date('tanggal');
            $table->enum('shift', ['pagi', 'siang', 'malam'])->default('pagi');
            $table->enum('tipe_piket', ['harian', 'mingguan', 'bulanan'])->default('harian');
            $table->string('lokasi')->nullable();
            $table->text('catatan')->nullable();
            $table->boolean('notifikasi_dikirim')->default(false);
            $table->timestamp('notifikasi_waktu')->nullable();
            $table->timestamps();
            $table->index('tanggal');
            $table->index('personel_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jadwal_piket');
    }
};
