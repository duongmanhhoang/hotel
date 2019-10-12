<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColToRoomInvoiceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('room_invoice', function (Blueprint $table) {
            $table->string('room_number', 191)->after('invoice_code');
            $table->text('note')->after('price')->nullable();
            $table->integer('status')->after('currency')->comment('0: Chưa thanh toán | 1: Đã thanh toán | 2: Trả phòng sớm | 4: Trả phòng muộn');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('room_invoice', function (Blueprint $table) {
            $table->dropColumn('room_number');
            $table->dropColumn('note');
            $table->dropColumn('status');
        });
    }
}
