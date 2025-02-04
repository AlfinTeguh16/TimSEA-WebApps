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
        Schema::create('tb_writer', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_users')->constrained('tb_users')->cascadeOnUpdate()->cascadeOnDelete();
            $table->text('profile_picture')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_writer');
    }
};
