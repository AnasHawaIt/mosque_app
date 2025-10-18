<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('halaqas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('quran_instructors_id')->constrained('quran_instructors')->cascadeOnDelete();
            $table->string('halaqa_name');
            $table->dateTime('halaqa_time')->nullable();
            $table->timestamps();


        });
    }

    public function down(): void
    {
        Schema::dropIfExists('halaqas');
    }
};
