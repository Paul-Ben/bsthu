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
                // APPLICATIONS
        Schema::create('applications', function (Blueprint $table) {
            $table->id();
            $table->string('application_no')->unique();
            $table->string('full_name');
            $table->string('email');
            $table->string('phone');
            $table->string('gender');
            $table->date('dob');
            $table->string('state');
            $table->string('lga');
            $table->string('country');
            $table->unsignedBigInteger('program_applied_id');
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');
            $table->string('document_path')->nullable();
            $table->timestamps();
        });

        // ADMISSIONS
        Schema::create('admissions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('application_id');
            $table->unsignedBigInteger('student_id');
            $table->unsignedBigInteger('admitted_by');
            $table->timestamp('admitted_at');
            $table->timestamps();
        });

       

        // COLLEGES
        Schema::create('colleges', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });

        // FACULTIES
        Schema::create('faculties', function (Blueprint $table) {
            $table->id();
            $table->foreignId('college_id')->constrained();
            $table->string('name');
            $table->timestamps();
        });

        // DEPARTMENTS
        Schema::create('departments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('faculty_id')->constrained();
            $table->string('name');
            $table->timestamps();
        });

        // COURSES
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->string('code');
            $table->string('title');
            $table->integer('credit_load');
            $table->integer('level');
            $table->enum('semester', ['first', 'second',]);
            $table->foreignId('department_id')->constrained();
            $table->timestamps();
        });

         // STUDENTS
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->foreignId('application_id')->constrained();
            $table->foreignId('user_id')->constrained();
            $table->string('reg_no')->unique();
            $table->string('gender');
            $table->date('dob');
            $table->text('address');
            $table->string('country');
            $table->string('state');
            $table->string('lga');
            $table->foreignId('department_id')->constrained();
            $table->year('entry_year');
            $table->integer('current_level');
            $table->enum('status', ['active', 'suspended', 'graduated'])->default('active');
            $table->timestamps();
        });

        // REGISTRATIONS
        Schema::create('registrations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->constrained();
            $table->string('session');
            $table->enum('semester', ['first', 'second']);
            $table->timestamps();
        });

        Schema::create('registration_course', function (Blueprint $table) {
            $table->id();
            $table->foreignId('registration_id')->constrained('registrations')->onDelete('cascade');
            $table->foreignId('course_id')->constrained('courses')->onDelete('cascade');
        });

        // RESULTS
        Schema::create('results', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->constrained();
            $table->foreignId('course_id')->constrained();
            $table->decimal('score', 5, 2);
            $table->string('grade');
            $table->string('session');
            $table->enum('semester', ['first', 'second']);
            $table->timestamps();
        });

        // PAYMENTS
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->constrained();
            $table->string('reference')->unique();
            $table->decimal('amount', 10, 2);
            $table->enum('payment_type', ['application', 'tuition', 'registration', 'others']);
            $table->enum('status', ['pending', 'success', 'failed']);
            $table->timestamp('paid_at')->nullable();
            $table->json('response_data')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
        Schema::dropIfExists('results');
        Schema::dropIfExists('registration_course');
        Schema::dropIfExists('registrations');
        Schema::dropIfExists('courses');
        Schema::dropIfExists('departments');
        Schema::dropIfExists('faculties');
        Schema::dropIfExists('colleges');
        Schema::dropIfExists('students');
        Schema::dropIfExists('admissions');
        Schema::dropIfExists('applications');
    }
};
