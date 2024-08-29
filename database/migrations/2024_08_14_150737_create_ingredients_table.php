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
        Schema::create('ingredients', function (Blueprint $table) {
            $table->string('name')->primary();
            $table->enum('type', [
                'meat',
                'vegetable',
                'fruit',
                'grain',
                'nut',
                'sauce',
                'dairy',
                'spice',
                'herb',
                'other'
            ]);
            $table->timestamps();
        });
    }
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ingredients');
    }
};
