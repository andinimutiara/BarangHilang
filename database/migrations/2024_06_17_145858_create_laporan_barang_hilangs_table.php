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
        Schema::create('laporan_barang_hilangs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('category_id')->constrained()->onDelete('cascade');
            $table->foreignId('lokasi_id')->constrained()->onDelete('cascade');
            $table->string('nama_barang');
            $table->text('deskripsi_barang');
            $table->text('deskripsi_kronologi');
            $table->string('tempat_kehilangan');
            $table->date('tanggal_kehilangan');
            $table->timestamps();
            $table->boolean('is_open')->default(1);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('laporan_barang_hilangs');
    }
};
