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
        Schema::create('ticket_reservations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('quote_id');
            $table->unsignedBigInteger('ticket_id');
            $table->integer('ticket_quantity')->default(1);
            $table->decimal('ticket_rate', 10, 2)->default(0.00);
            $table->decimal('ticket_amount_lkr', 10, 2)->default(0.00);
            $table->decimal('ticket_amount_usd', 10, 2)->default(0.00);
            $table->text('airline_details')->nullable();
            $table->text('booking_summary')->nullable();
            $table->timestamps();

            $table->foreign('quote_id')->references('id')->on('quotations')->onDelete('cascade');
            $table->foreign('ticket_id')->references('id')->on('tickets')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ticket_reservations');
    }
};
