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
        Schema::create('rentals', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->date('tanggal_sewa');
            $table->date('tanggal_kembali');
            $table->date('tanggal_diambil')->nullable();
            $table->date('tanggal_dikembalikan')->nullable();
            $table->enum('status', ['pending', 'ongoing', 'returned', 'completed'])->default('pending');
            $table->integer('total_harga')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rentals');
    }
};
