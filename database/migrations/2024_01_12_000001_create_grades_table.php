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
        Schema::create('grades', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('subject_id')->constrained('subjects')->onDelete('cascade');
            $table->foreignId('class_id')->constrained('classes')->onDelete('cascade');
            $table->string('assessment_type');
            $table->string('assessment_name');
            $table->decimal('score', 5, 2);
            $table->decimal('max_score', 5, 2)->default(100.00);
            $table->decimal('percentage', 5, 2);
            $table->string('grade_letter')->nullable();
            $table->date('assessment_date');
            $table->foreignId('teacher_id')->constrained('users')->onDelete('cascade');
            $table->text('notes')->nullable();
            $table->timestamps();
            
            $table->index(['student_id', 'subject_id', 'assessment_date']);
            $table->index(['class_id', 'assessment_date']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('grades');
    }
};