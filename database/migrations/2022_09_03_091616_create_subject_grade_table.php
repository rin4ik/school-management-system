<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subject_grade', function (Blueprint $table) {
            $table->id();
            $table->foreignId('subject_id')->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('group_id')->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('student_id')->constrained()->onDelete('cascade')->onUpdate('cascade')->on('users');
            $table->foreignId('teacher_id')->constrained()->onDelete('cascade')->onUpdate('cascade')->on('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('subject_grade');
    }
};
