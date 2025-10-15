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
        Schema::create('travel_letters', function (Blueprint $table) {
            $table->id();
            $table->string('letter_number')->unique();
            $table->string('lecturer_name');
            $table->string('lecturer_nip');
            $table->string('lecturer_rank'); // Pangkat/Golongan
            $table->string('destination');
            $table->text('purpose');
            $table->date('start_date');
            $table->date('end_date');
            $table->string('vehicle');
            $table->string('dipa_number');   // Nomor DIPA
            $table->date('dipa_date');       // Tanggal DIPA
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('travel_letters');
    }
};