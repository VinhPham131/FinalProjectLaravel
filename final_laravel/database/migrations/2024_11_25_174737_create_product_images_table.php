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
        Schema::create('product_images', function (Blueprint $table) {
            $table->id();
            $table->string('image_path'); // URL for the product image
            $table->text('alt_text')->nullable(); // Optional alt text for the image
            $table->integer('sort_order')->default(0); // To define the order of images
            $table->boolean('is_primary')->default(false); // To mark the primary image for the product
            $table->foreignId('product_id')->constrained('products')->onDelete('cascade'); // Linking image to product
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_images');
    }
};
