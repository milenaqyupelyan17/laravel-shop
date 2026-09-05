<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();

            $table->string('title');
            $table->text('description')->nullable();

            $table->decimal('price', 10, 2);
            $table->decimal('old_price', 10, 2)->nullable();

            $table->integer('discount')->nullable();

            $table->string('image')->nullable();

            $table->string('category')->nullable();

            $table->timestamps();
        });
    }


    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};