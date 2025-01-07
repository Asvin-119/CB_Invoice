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
        Schema::create('tour_location_transports', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('quote_id');
            $table->unsignedBigInteger('tour_location_id'); // Foreign key to the tour locations table
            $table->decimal('rate', 10, 2); // Rate in currency
            $table->decimal('touramount_rs', 10, 2);
            $table->decimal('touramount_usd', 10, 2);
            $table->timestamps();

            $table->foreign('quote_id')->references('id')->on('quotations')->onDelete('cascade');
            $table->foreign('tour_location_id')->references('id')->on('tour_locations')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tour_location_transports');
    }
};
