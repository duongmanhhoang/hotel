<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DropColFromInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('invoices', function (Blueprint $table) {
            $table->dropColumn('user_id');
            $table->dropColumn('customer_email');
            $table->dropColumn('customer_address');
            $table->dropColumn('messages');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('invoices', function (Blueprint $table) {
            $table->integer('user_id')->default(0);
            $table->string('customer_email', 191)->nullable();
            $table->string('customer_address')->nullable();
            $table->text('messages')->nullable();
        });
    }
}
