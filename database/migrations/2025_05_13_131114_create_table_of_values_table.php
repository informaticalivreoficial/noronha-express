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
        Schema::create('table_of_values', function (Blueprint $table) {
            $table->increments('id');
            $table->decimal('horti_fruit', 10, 2)->nullable()->default(0);            
            $table->decimal('cubage', 10, 2)->nullable()->default(0);            
            $table->decimal('secure', 10, 2)->nullable()->default(0);            
            $table->decimal('dry_weight', 10, 2)->nullable()->default(0);            
            $table->decimal('package', 10, 2)->nullable()->default(0);            
            $table->decimal('glace', 10, 2)->nullable()->default(0);            
            $table->decimal('tax', 10, 2)->nullable()->default(0);         
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
    */
    public function down(): void
    {
        Schema::dropIfExists('table_of_values');
    }
};
