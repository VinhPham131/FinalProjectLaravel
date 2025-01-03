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
        Schema::create('sales', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Sale name (e.g., "Bracelet", "Summer 2024")
            $table->enum('sale_target_type', ['product', 'category', 'collection']); // Type of target
            $table->foreignId('sale_target_id')->nullable(); // Foreign key for the target (could be product, category, or collection)
            $table->decimal('percentage', 5, 2); // Discount percentage (e.g., 10.00)
            $table->date('start_date')->nullable(); // Sale start date
            $table->date('end_date')->nullable(); // Sale end date
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sales');
    }
};
