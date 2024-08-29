<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('available_products', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id');
            $table->string('ingredient_name');
            $table->decimal('quantity', 10, 2);
            $table->primary(['user_id', 'ingredient_name']);
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('ingredient_name')->references('name')->on('ingredients')->onDelete('cascade');
            $table->timestamps();
        });
    }
    
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('available_products');
    }
};
