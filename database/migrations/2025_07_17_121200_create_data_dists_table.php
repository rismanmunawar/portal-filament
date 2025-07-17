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
        Schema::create('data_dists', function (Blueprint $table) {
            $table->id();
            $table->string('branch');
            $table->string('plant');
            $table->integer('code_dist')->unique()->nullable();
            $table->string('name_dist');
            $table->string('status_dist');
            $table->string('channel')->nullable();

            // Harus nullable supaya SET NULL bisa jalan
            $table->foreignId('rom_id')
                ->nullable()
                ->constrained('data_r_o_m_s')
                ->nullOnDelete();

            $table->foreignId('nom_id')
                ->nullable()
                ->constrained('data_n_o_m_s')
                ->nullOnDelete();

            $table->foreignId('it_id')
                ->nullable()
                ->constrained('data_i_t_s')
                ->nullOnDelete();

            $table->string('region')->nullable();
            $table->boolean('status_plant')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('data_dists');
    }
};
