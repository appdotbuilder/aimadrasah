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
        Schema::create('exams', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description')->nullable();
            $table->foreignId('subject_id')->constrained('subjects')->onDelete('cascade');
            $table->foreignId('class_id')->constrained('classes')->onDelete('cascade');
            $table->foreignId('teacher_id')->constrained('users')->onDelete('cascade');
            $table->datetime('start_time');
            $table->datetime('end_time');
            $table->integer('duration');
            $table->integer('total_questions')->default(0);
            $table->decimal('total_points', 5, 2)->default(100.00);
            $table->boolean('randomize_questions')->default(false);
            $table->boolean('show_results_immediately')->default(false);
            $table->enum('status', ['draft', 'published', 'ongoing', 'completed'])->default('draft');
            $table->timestamps();
            
            $table->index(['subject_id', 'class_id']);
            $table->index(['status', 'start_time']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('exams');
    }
};