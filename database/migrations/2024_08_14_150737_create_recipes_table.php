<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    
    public function up()
    {
        Schema::create('recipes', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description')->nullable();
            $table->unsignedInteger('preparation_time');
            $table->unsignedBigInteger('author');
            $table->enum('meal_time', ['breakfast', 'lunch', 'dinner'])->nullable();
            $table->timestamps();

            // Foreign key
            $table->foreign('author')->references('id')->on('users')->onDelete('cascade');
        });
    }
    
    
    public function down(): void
    {
        Schema::table('recipes', function (Blueprint $table) {
            // Drop the FK before dropping the table
            $table->dropForeign(['author']);
        });

        Schema::dropIfExists('recipes');
    }
};
