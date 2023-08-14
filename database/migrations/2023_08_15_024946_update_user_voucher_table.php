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
        //
        Schema::table('user_voucher', function (Blueprint $table) {
            // Drop the existing column first, if it exists
            $table->dropColumn('voucher_code');

            // Rename 'voucher_id' to 'voucher_code' and change the type
            $table->unsignedBigInteger('voucher_code')->change();
            $table->renameColumn('voucher_id', 'voucher_code');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::table('user_voucher', function (Blueprint $table) {
            // Drop the existing column first, if it exists
            $table->dropColumn('voucher_id');

            // Rename 'voucher_code' back to 'voucher_id' and change the type
            $table->unsignedInteger('voucher_id')->change();
            $table->renameColumn('voucher_code', 'voucher_id');
        });
    }
};
