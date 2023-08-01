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
        Schema::table('vouchers', function (Blueprint $table) {
            //
            $table->string('code');
            $table->dateTime('expired')->default('1000-01-01 00:00:00');
            $table->string('quantity')->nullable()->comment('số lượng giới hạn sử dụng voucher');
            $table->string('unit')->comment('Percent , VND');
            $table->boolean('is_infinite')->default(false)->comment('Xác định xem là có giới hạn số lượng sử dụng hay không');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('vouchers', function (Blueprint $table) {
            //
            // Xóa các trường đã thêm
            $table->dropColumn('code');
            $table->dropColumn('expired');
            $table->dropColumn('quantity');
            $table->dropColumn('unit');
            $table->dropColumn('is_infinite');
        });
    }
};
