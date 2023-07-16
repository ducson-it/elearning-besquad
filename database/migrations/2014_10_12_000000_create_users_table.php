<?php

use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;
class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Table: roles
        Schema::create('roles', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('description');
            $table->timestamps();
            $table->softDeletes();
        });

        // Table: permissions
        Schema::create('permissions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('description');
            $table->timestamps();
            $table->softDeletes();
        });

        // Table: role_permission
        Schema::create('role_permission', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('role_id');
            $table->unsignedInteger('permission_id');
            $table->timestamps();
            $table->softDeletes();
            // $table->foreign('role_id')->references('id')->on('roles')->onDelete('cascade');
            // $table->foreign('permission_id')->references('id')->on('permissions')->onDelete('cascade');
        });

        // Table: categories
        Schema::create('categories', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('slug');
            $table->text('description');
            $table->timestamps();
            $table->softDeletes();
        });
        //tạo bảng user
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('email');
            $table->string('password');
            $table->string('avatar')->nullable();
            $table->string('username')->nullable();
            $table->string('phone');
            $table->string('address')->nullable();
            $table->integer('point')->default(0);
            $table->unsignedInteger('role_id')->default(2);
            $table->integer('active')->default(1);
            $table->timestamps();
            $table->softDeletes();

            // $table->foreign('role_id')->references('id')->on('roles')->onDelete('cascade');
        });
        // Table: vouchers
        Schema::create('vouchers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('value');
            $table->timestamps();
            $table->softDeletes();
        });

        // Table: user_voucher
        Schema::create('user_voucher', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('voucher_id');
            $table->unsignedInteger('user_id');
            $table->timestamps();
            $table->softDeletes();
            // $table->foreign('voucher_id')->references('id')->on('vouchers')->onDelete('cascade');
            // $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
        // Table: courses
        Schema::create('courses', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('slug');
            $table->integer('price');
            $table->unsignedInteger('user_id')->nullable();
            $table->integer('discount');
            $table->integer('status');
            $table->integer('featured');
            $table->unsignedInteger('category_id');
            $table->json('image');
            $table->text('description');
            $table->text('is_free');
            $table->timestamps();
            $table->softDeletes();
            // $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
            // $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
        });

        // Table: modules
        Schema::create('modules', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('slug');
            $table->unsignedInteger('course_id');
            $table->text('description');
            $table->timestamps();
            $table->softDeletes();
            // $table->foreign('course_id')->references('id')->on('courses')->onDelete('cascade');
        });

        // Table: lessons
        Schema::create('lessons', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('slug');
            $table->unsignedInteger('course_id');
            $table->unsignedInteger('module_id');
            $table->string('document');
            $table->string('video_id');
            $table->integer('status');
            $table->text('description');
            $table->integer('is_trial_lesson');
            $table->timestamps();
            $table->softDeletes();
            // $table->foreign('course_id')->references('id')->on('courses')->onDelete('cascade');
            // $table->foreign('module_id')->references('id')->on('modules')->onDelete('cascade');
        });

        // Table: sliders
        Schema::create('sliders', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('content');
            $table->string('text_color');
            $table->string('url_btn');
            $table->text('content_btn');
            $table->json('image');
            $table->integer('status');
            $table->timestamps();
            $table->softDeletes();
        });

        // Table: category_blogs
        Schema::create('category_blogs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('slug');
            $table->text('description');
            $table->timestamps();
            $table->softDeletes();
        });

        // Table: blogs
        Schema::create('blogs', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id');
            $table->string('title');
            $table->string('slug');
            $table->json('image');
            $table->integer('view');
            $table->string('description_short');
            $table->text('content');
            $table->unsignedInteger('category_blog_id');
            $table->timestamps();
            $table->softDeletes();
            // $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            // $table->foreign('category_blog_id')->references('id')->on('category_blogs')->onDelete('cascade');
        });

        // Table: comments
        Schema::create('comments', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id');
            $table->string('content');
            $table->integer('status');
            $table->unsignedInteger('commentable_id');
            $table->string('commentable_type');
            $table->timestamps();
            $table->softDeletes();
            // $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->index(['commentable_id', 'commentable_type']);
        });

        // Table: tags
        Schema::create('tags', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('description')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        // Table: notifications
        Schema::create('notifications', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->string('content');
            $table->string('is_send_email');
            $table->date('expired');
            $table->timestamps();
            $table->softDeletes();
        });

        // Table: posts
        Schema::create('posts', function (Blueprint $table) {
            $table->increments('id');
            $table->text('content');
            $table->unsignedInteger('user_id');
            $table->timestamps();
            $table->softDeletes();
            // $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });

        // Table: taggables
        Schema::create('taggables', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('tag_id');
            $table->unsignedInteger('taggable_id');
            $table->string('taggable_type');
            $table->timestamps();
            $table->softDeletes();
            // $table->foreign('tag_id')->references('id')->on('tags')->onDelete('cascade');
            $table->index(['taggable_id', 'taggable_type']);
        });

        // Table: orders
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');
            $table->date('order_date');
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('course_id');
            $table->timestamps();
            $table->softDeletes();
            // $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            // $table->foreign('course_id')->references('id')->on('courses')->onDelete('cascade');
        });

        // Table: statues
        Schema::create('statuses', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->unsignedInteger('statusable_id');
            $table->string('statusable_type');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Drop all tables in reverse order
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
}

