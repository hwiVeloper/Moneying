<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddAssetsForiegnKeyToAccounts extends Migration
{
    /**
    * Run the migrations.
    *
    * @return void
    */
    public function up()
    {
        Schema::table('accounts', function (Blueprint $table) {
            $table->integer('asset_id')->after('category_id')->unsigned()->index();

            $table->foreign('asset_id')->references('id')->on('assets');
        });
    }

    /**
    * Reverse the migrations.
    *
    * @return void
    */
    public function down()
    {
        Schema::table('accounts', function(Blueprint $table) {
            $table->dropColumn('asset_id');
        });
    }
}
