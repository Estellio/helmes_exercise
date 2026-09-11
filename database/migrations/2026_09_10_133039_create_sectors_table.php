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
        Schema::create('sectors', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('sector_number');
            $table->string('name');
            $table->unsignedInteger('parent_sector_number')->nullable();

            // Declare unique index seperately
            $table->unique('sector_number');
            $table->foreign('parent_sector_number')->references('sector_number')->on('sectors')->nullOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sectors');
    }
};
