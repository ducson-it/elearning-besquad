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
        Schema::create('questions', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug');
            $table->unsignedInteger('quiz_id');
            $table->timestamps();
        });
        Schema::create('answers', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('correct_answer')->default(0);
            $table->unsignedInteger('question_id');
            $table->timestamps();
        });
        Schema::create('quiz', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug');
            $table->integer('quiz_type');
            $table->unsignedInteger('course_id');
            $table->unsignedInteger('module_id')->nullable();
            $table->timestamps();
        });
        Schema::create('quiz_detail', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('quiz_id');
            $table->unsignedInteger('question_id');
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
        Schema::dropIfExists('questions');
        Schema::dropIfExists('answers');
        Schema::dropIfExists('quiz');
        Schema::dropIfExists('quiz_detail');
    }
};
