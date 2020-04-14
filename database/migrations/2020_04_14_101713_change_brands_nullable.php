<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeBrandsNullable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('brands', function (Blueprint $table) {
            $table->string('referee_url')->nullable()->change();
            $table->json('products')->nullable()->change();
            $table->string('referral_css_url')->nullable()->change();
            $table->string('referral_notify_email')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('brands', function (Blueprint $table) {
            $table->string('referee_url')->nullable(false)->change();
            $table->json('products')->nullable(false)->change();
            $table->string('referral_css_url')->nullable(false)->change();
            $table->string('referral_notify_email')->nullable(false)->change();
        });
    }
}
