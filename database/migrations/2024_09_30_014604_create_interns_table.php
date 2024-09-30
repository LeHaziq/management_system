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
        Schema::create('interns', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('letter')->nullable();
            $table->string('education_level');
            $table->year('education_year');
            $table->string('school_university');
            $table->json('skills')->nullable();
            $table->string('university');
            $table->integer('training_period');
            $table->date('start_date');
            $table->date('end_date');
            $table->string('picture')->nullable();
            $table->string('resume')->nullable();
            $table->enum('status', ['accepted', 'rejected', 'active', 'completed', 'review'])->default('review');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('interns');
    }
};
