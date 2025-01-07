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
        Schema::create('foodand_beverages', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('quote_id');
            $table->json('food_type'); // Use string if storing as comma-separated values
            $table->decimal('rate', 10, 2)->default(0.00);
            $table->decimal('mealamount_rs', 10, 2);
            $table->decimal('mealamount_usd', 10, 2);
            $table->json('meals'); // Use string if storing as comma-separated values
            $table->timestamps();

            $table->foreign('quote_id')->references('id')->on('quotations')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('foodand_beverages');
    }
};
