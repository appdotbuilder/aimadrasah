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
        Schema::table('users', function (Blueprint $table) {
            $table->enum('role', ['admin', 'teacher', 'student', 'parent'])->default('student')->after('email');
            $table->string('phone')->nullable()->after('email');
            $table->string('student_id')->nullable()->unique()->after('phone');
            $table->string('parent_id')->nullable()->after('student_id');
            $table->enum('status', ['active', 'inactive'])->default('active')->after('parent_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['role', 'phone', 'student_id', 'parent_id', 'status']);
        });
    }
};