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
        Schema::create('categories',function(Blueprint $table){
            $table->id();
            $table->string('category_name');
            $table->string('category_slug');
            $table->text('category_dscp');
            $table->enum('status', ['ACTIVE', 'DEACTIVE']);
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};
