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
        Schema::create('data_dist_it', function (Blueprint $table) {
            $table->id();
            $table->foreignId('data_dist_id')->constrained('data_dists')->onDelete('cascade');
            $table->foreignId('data_it_id')->constrained('data_i_t_s')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('data_dist_it');
    }
};
