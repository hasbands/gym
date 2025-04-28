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
        Schema::create('memberships', function (Blueprint $table) {
            $table->id();
            $table->string('order_id');
            $table->foreignId('user_id');
            $table->foreignId('master_paket_id')->nullable();
            $table->foreignId('master_suplemen_id')->nullable();
            $table->integer('jumlah_suplemen')->nullable();
            $table->date('mulai');
            $table->date('selesai');
            $table->string('metode_pembayaran');
            $table->string('snap_token')->nullable();
            $table->string('total_bayar');
            $table->string('member_status');
            $table->string('status_pembayaran');
            $table->timestamps();
            
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('master_paket_id')->references('id')->on('master_pakets')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('master_suplemen_id')->references('id')->on('master_suplemens')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('memberships');
    }
};
