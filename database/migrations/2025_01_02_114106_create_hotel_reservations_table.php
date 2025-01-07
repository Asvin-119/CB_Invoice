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
        Schema::create('hotel_reservations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('quote_id');
            $table->unsignedBigInteger('hotel_location_id');
            $table->unsignedBigInteger('hotel_type_id');
            $table->integer('hlquantity');
            $table->decimal('rate', 10, 2);
            $table->decimal('hlamount_rs', 15, 2);
            $table->decimal('hlamount_usd', 15, 2);
            $table->timestamps();

            $table->foreign('quote_id')->references('id')->on('quotations')->onDelete('cascade');
            $table->foreign('hotel_type_id')->references('id')->on('hotel_types')->onDelete('cascade');
            $table->foreign('hotel_location_id')->references('id')->on('hotel_locations')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hotel_reservations');
    }
};
