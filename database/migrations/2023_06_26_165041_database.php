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
        // Table roles
        Schema::create('roles', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('description');
            $table->timestamps();
        });
        // Table permissions
        Schema::create('permissions', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('description');
            $table->timestamps();
        });

        // Table role_permission
        Schema::create('role_permission', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('role_id');
            $table->unsignedBigInteger('permission_id');
            $table->timestamps();

            $table->foreign('role_id')->references('id')->on('roles');
            $table->foreign('permission_id')->references('id')->on('permissions');
        });

        // Table vouchers
        Schema::create('vouchers', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('value');
            $table->timestamps();
        });

        // Table user_voucher
        Schema::create('user_voucher', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('voucher_id');
            $table->unsignedBigInteger('user_id');
            $table->timestamps();

            $table->foreign('voucher_id')->references('id')->on('vouchers');
            $table->foreign('user_id')->references('id')->on('users');
        });

        // Table categories
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug');
            $table->text('description');
            $table->timestamps();
        });

        // Table courses
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug');
            $table->integer('price');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->integer('discount');
            $table->integer('status');
            $table->integer('featured');
            $table->unsignedBigInteger('category_id');
            $table->string('image');
            $table->text('description');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('category_id')->references('id')->on('categories');
        });

        // Table modules
        Schema::create('modules', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug');
            $table->unsignedBigInteger('course_id');
            $table->text('description');
            $table->timestamps();

            $table->foreign('course_id')->references('id')->on('courses');
        });

        // Table lessons
        Schema::create('lessons', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug');
            $table->unsignedBigInteger('course_id');
            $table->unsignedBigInteger('module_id');
            $table->string('document');
            $table->string('video_id');
            $table->integer('status');
            $table->text('description');
            $table->timestamps();

            $table->foreign('course_id')->references('id')->on('courses');
            $table->foreign('module_id')->references('id')->on('modules');
        });

        // Table sliders
        Schema::create('sliders', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('content');
            $table->string('text_color');
            $table->string('url_btn');
            $table->text('content_btn');
            $table->string('image');
            $table->integer('status');
            $table->timestamps();
        });

        // Table category_blogs
        Schema::create('category_blogs', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug');
            $table->text('description');
            $table->timestamps();
        });

        // Table blogs
        Schema::create('blogs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('title');
            $table->string('slug');
            $table->string('image');
            $table->integer('view');
            $table->string('description_short');
            $table->text('content');
            $table->unsignedBigInteger('category_blog_id');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('category_blog_id')->references('id')->on('category_blogs');
        });

        // Table comments
        Schema::create('comments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('content');
            $table->integer('status');
            $table->unsignedBigInteger('commentable_id');
            $table->string('commentable_type');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
        });

        // Table tags
        Schema::create('tags', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('description');
            $table->timestamps();
        });

        // Table notifications
        Schema::create('notifications', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('content');
            $table->string('is_send_email');
            $table->date('expired');
            $table->timestamps();
        });

        // Table posts
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->text('content');
            $table->unsignedBigInteger('user_id');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
        });

        // Table taggables
        Schema::create('taggables', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('tag_id');
            $table->unsignedBigInteger('taggable_id');
            $table->string('taggable_type');
            $table->timestamps();

            $table->foreign('tag_id')->references('id')->on('tags');
            $table->foreign('taggable_id')->references('id')->on('posts');
        });

        // Table orders
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->date('order_date');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('course_id');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('course_id')->references('id')->on('courses');
        });

        // Table statues
        Schema::create('statuses', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('statusable_id');
            $table->integer('statusable_type');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('statuses');
        Schema::dropIfExists('orders');
        Schema::dropIfExists('taggables');
        Schema::dropIfExists('posts');
        Schema::dropIfExists('notifications');
        Schema::dropIfExists('tags');
        Schema::dropIfExists('comments');
        Schema::dropIfExists('blogs');
        Schema::dropIfExists('category_blogs');
        Schema::dropIfExists('sliders');
        Schema::dropIfExists('lessons');
        Schema::dropIfExists('modules');
        Schema::dropIfExists('courses');
        Schema::dropIfExists('categories');
        Schema::dropIfExists('user_voucher');
        Schema::dropIfExists('vouchers');
        Schema::dropIfExists('role_permission');
        Schema::dropIfExists('permissions');
        Schema::dropIfExists('roles');
        Schema::dropIfExists('users');
    }
};
