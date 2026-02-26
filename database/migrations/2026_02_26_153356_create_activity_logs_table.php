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
        Schema::create('activity_logs', function (Blueprint $table) {
            $table->id();
            $table->string('model'); // Nama model (PermitService)
            $table->unsignedBigInteger('model_id'); // ID dari data yang diproses
            $table->string('action'); // created, updated, deleted
            $table->json('payload')->nullable(); // Data lama/baru
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('set null'); // Siapa yang melakukan
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('activity_logs');
    }
};
