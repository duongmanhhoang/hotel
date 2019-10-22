<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColunmToWebSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('web_settings', function (Blueprint $table) {
            $table->text('logo_footer');
            $table->string('youtube',191)->nullable();
            $table->string('google_plus',191)->nullable();
            $table->string('phone',15)->nullable();
            $table->string('address',191)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('web_settings', function (Blueprint $table) {
            $table->dropColumn('logo_footer');
            $table->dropColumn('youtube');
            $table->dropColumn('google_plus');
            $table->dropColumn('phone');
            $table->dropColumn('address');
        });
    }
}
