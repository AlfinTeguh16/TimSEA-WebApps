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

        // Schema::create('tb_users', function (Blueprint $table) {
        //     $table->id();
        //     $table->string('username', 255)->nullable(false);
        //     $table->string('email', 255)->unique()->nullable(false);
        //     $table->string('password', 255)->nullable(false);
        //     $table->string('phone', 20)->nullable(true);
        //     $table->text('profile_picture')->nullable();
        //     $table->enum('role', ['admin', 'writer', 'talent', 'company', 'media_partner'])->default('talent');
        //     $table->boolean('is_blocked')->default(false);
        //     $table->timestamps();
        // });
    

        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};
