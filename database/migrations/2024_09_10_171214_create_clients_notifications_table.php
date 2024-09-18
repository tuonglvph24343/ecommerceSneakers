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
        Schema::create('clients_notifications', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
        $table->string('type');
        $table->text('data');
        $table->boolean('is_read')->default(false);
      
        
        $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clients_notifications');
    }
};
