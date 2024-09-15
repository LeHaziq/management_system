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
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->foreignId('agency_id')->constrained()->cascadeOnDelete();
            $table->string('pic_agency');
            $table->integer('contract_period');
            $table->integer('warranty_period');
            $table->date('start_date');
            $table->date('end_date');
            $table->decimal('price', 15, 2);
            $table->string('SST_file')->nullable();
            $table->string('notes')->nullable();
            $table->string('creator');
            $table->string('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
