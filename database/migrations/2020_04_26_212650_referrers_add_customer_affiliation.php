<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ReferrersAddCustomerAffiliation extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('referrers', function (Blueprint $table) {
            $table->unsignedInteger('customer_affiliation')->default(0);
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
            $table->dropColumn('customer_affiliation');
        });
    }
}
