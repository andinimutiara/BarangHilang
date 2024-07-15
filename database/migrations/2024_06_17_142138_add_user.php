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
            $table->string('tempat_lahir')->nullable();
            $table->date('tanggal_lahir')->nullable();
            $table->string('agama')->nullable();
            $table->string('status_pekerjaan')->nullable();
            $table->string('nomor_id')->nullable();
            $table->string('alamat')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        SCHEMA::table('users', function (Blueprint $table) {
            $table->dropColumn('tempat_lahir');
            $table->dropColumn('tanggal_lahir');
            $table->dropColumn('agama');
            $table->dropColumn('status_pekerjaan');
            $table->dropColumn('nomor_id');
            $table->dropColumn('alamat');
        });
    }
};
