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
        Schema::create('monitor_zndsus', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');

            $table->string('plant');
            $table->string('name_dist');

            // Ambil otomatis dari relasi ke data_dists
            $table->foreignId('rom_id')->nullable()->constrained('data_r_o_m_s')->nullOnDelete();
            $table->foreignId('nom_id')->nullable()->constrained('data_n_o_m_s')->nullOnDelete();
            $table->foreignId('it_id')->nullable()->constrained('data_i_t_s')->nullOnDelete();

            $table->date('uploaded_at');
            $table->boolean('has_error')->default(false);

            // Kolom day_01 sampai day_31
            for ($i = 1; $i <= 31; $i++) {
                $day = str_pad($i, 2, '0', STR_PAD_LEFT);
                $table->string("day_$day")->nullable();
            }
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('monitor_zndsus');
    }
};
