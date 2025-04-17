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
        Schema::create('manifest_items', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('manifest')->nullable();
            $table->string('unit')->nullable();
            $table->string('description')->nullable();
            $table->string('quantity')->nullable();
            $table->decimal('horti-fruit', 10, 2)->nullable();            
            $table->decimal('cubage', 10, 2)->nullable();            
            $table->decimal('secure', 10, 2)->nullable();            
            $table->decimal('dry_weight', 10, 2)->nullable();            
            $table->decimal('package', 10, 2)->nullable();            
            $table->decimal('glace', 10, 2)->nullable();            
            $table->decimal('tax', 10, 2)->nullable();         
            
            $table->timestamps();

            $table->foreign('manifest')->references('id')->on('manifests')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('manifest_items');
    }
};
