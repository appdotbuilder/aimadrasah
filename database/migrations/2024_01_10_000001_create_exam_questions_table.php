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
        Schema::create('exam_questions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('exam_id')->constrained('exams')->onDelete('cascade');
            $table->text('question');
            $table->enum('type', ['multiple_choice', 'essay', 'file_upload'])->default('multiple_choice');
            $table->json('options')->nullable();
            $table->text('correct_answer')->nullable();
            $table->decimal('points', 5, 2)->default(1.00);
            $table->integer('order')->default(1);
            $table->timestamps();
            
            $table->index(['exam_id', 'order']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('exam_questions');
    }
};