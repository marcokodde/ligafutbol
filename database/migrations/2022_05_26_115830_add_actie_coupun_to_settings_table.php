<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddActieCoupunToSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('settings', function (Blueprint $table) {
            $table->boolean('active_coupon')->default(0)->after('max_teams_by_category')->comment('¿Activo el cupón?');
            $table->string('key_to_coupon',10)->nullable()->after('active_coupon')->comment('Clave para el cupón');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('settings', function (Blueprint $table) {
            $table->dropColumn('active_coupon');
            $table->dropColumn('key_to_coupon');

        });
    }
}
