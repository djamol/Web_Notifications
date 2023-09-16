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
        Schema::create('notifications', function (Blueprint $table) {
            $table->id();
            $table->string('type');
            $table->unsignedBigInteger('notifiable_id');
            $table->unsignedBigInteger('user_id');
            $table->string('short_text');
            $table->timestamp('expiration');
            $table->string('destination');
            $table->timestamp('read_at')->nullable();
            $table->string('notifiable_type');
            $table->boolean('read')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notifications');
    }
};
