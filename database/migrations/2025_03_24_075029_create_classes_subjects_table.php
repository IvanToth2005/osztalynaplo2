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
        Schema::create('classes_subjects', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('class_id');  
            $table->unsignedBigInteger('subject_id');
            $table->foreign('class_id')->references('id')->on('school_classes');
            $table->foreign('subject_id')->references('id')->on('subjects');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('classes_subjects');
    }
};
