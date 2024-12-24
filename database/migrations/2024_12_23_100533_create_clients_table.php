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
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            $table->string('salutation', 10);
            $table->string('first_name');
            $table->string('last_name');
            $table->string('display_name');
            $table->string('email')->unique();
            $table->string('mobile_phone');
            $table->string('client_image')->nullable(); // Optional field
            $table->string('tour_consultant');
            $table->string('source');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clients');
    }
};
