<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('brands',function(Blueprint $table){
            $table->id();
            $table->string('brand_name');
            $table->string('brand_slug');
            $table->string('brand_logo');
            $table->enum('status', ['ACTIVE', 'DEACTIVE']);
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('brands');
    }
};
