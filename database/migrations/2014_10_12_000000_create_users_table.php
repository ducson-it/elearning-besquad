<?php

use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;
class CreateUsersTable extends Migration
{
    public function up()
    {
        // Table users
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email');
            $table->string('password');
            $table->string('avatar')->nullable();
            $table->string('username');
            $table->string('phone')->nullable();
            $table->string('address')->nullable();
            $table->integer('point');
            $table->unsignedBigInteger('role_id');
            $table->integer('active');
            $table->timestamps();
            $table->foreign('role_id')->references('id')->on('roles');
        });

    }
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
