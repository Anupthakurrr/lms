<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('course_instructor', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->foreignId('course_id')->constrained('courses')->onDelete('cascade');//when data is delete at other place then it also delete form here
            $table->foreignId('instructor_id')->constrained('instructors')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('course_instructor');
    }
};
