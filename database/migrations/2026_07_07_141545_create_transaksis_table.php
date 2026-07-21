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
        Schema::create('transaksis', function (Blueprint $table) {
            $table->id();

            // Kasir yang melayani transaksi
            $table->foreignId('user_id')
                ->constrained('users')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();

            // Nomor transaksi
            $table->string('kode_transaksi')->unique();

            // Tanggal transaksi
            $table->dateTime('tanggal_transaksi');

            // Total transaksi
            $table->decimal('total_harga', 15, 2)->default(0);

            // Uang yang dibayarkan
            $table->decimal('bayar', 15, 2)->default(0);

            // Uang kembalian
            $table->decimal('kembalian', 15, 2)->default(0);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksis');
    }
};