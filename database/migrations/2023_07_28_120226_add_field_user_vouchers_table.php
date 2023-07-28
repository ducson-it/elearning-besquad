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
        Schema::table('user_voucher', function (Blueprint $table) {
            //
            $table->boolean('is_used')->default(0)->comment('Xác định user đã sử dụng voucher hay chưa');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user_voucher', function (Blueprint $table) {
            //
            $table->dropColumn('is_used');
        });
    }
};
