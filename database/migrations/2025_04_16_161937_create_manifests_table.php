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
        Schema::create('manifests', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('trip')->nullable();
            $table->string('type')->nullable();
            $table->string('object')->nullable();
            $table->unsignedInteger('company')->nullable();
            $table->unsignedInteger('user')->nullable(); 
            $table->string('status')->nullable();           
            
            /** address */
            $table->string('zipcode')->nullable();
            $table->string('street')->nullable();
            $table->string('number')->nullable();
            $table->string('complement')->nullable();
            $table->string('neighborhood')->nullable();
            $table->string('state')->nullable();
            $table->string('city')->nullable();            
            
            $table->text('information')->nullable();
            $table->string('contact')->nullable();
            $table->string('created')->nullable();

            $table->timestamps();

            $table->foreign('trip')->references('id')->on('trips')->onDelete('CASCADE');
            $table->foreign('company')->references('id')->on('companies');
            $table->foreign('user')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('manifests');
    }
};
