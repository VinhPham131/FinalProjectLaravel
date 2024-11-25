<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description')->nullable();
            $table->decimal('price', 10, 2)->default(0);
            $table->integer('quantity');
            $table->string('material')->nullable();
            $table->string('size', 50)->nullable();
            $table->string('stylecode', 50)->nullable();
            $table->string('collection')->nullable();
            $table->string('productcode', 50)->unique();
            $table->string('color', 50)->nullable();
            $table->foreignId('category_id')->constrained('product_categories')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products'); // Drop the products table
    }
};
