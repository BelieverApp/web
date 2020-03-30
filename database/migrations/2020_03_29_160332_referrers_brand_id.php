<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ReferrersBrandId extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('referrers', function (Blueprint $table) {
            $table->dropForeign(['referral_org_id']);
            $table->dropColumn('referral_org_id');

            $table->unsignedInteger('brand_id')->nullable(false);
            $table->foreign('brand_id')->references('id')->on('brands');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('referrers', function (Blueprint $table) {
            $table->dropForeign(['brand_id']);
            $table->dropColumn('brand_id');

            $table->unsignedInteger('referral_org_id')->nullable(false);
            $table->foreign('referral_org_id')->references('id')->on('referral_orgs');
        });
    }
}
