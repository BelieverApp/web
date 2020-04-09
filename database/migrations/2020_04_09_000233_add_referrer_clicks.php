<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddReferrerClicks extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('referrer_clicks', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('referrer_id')->nullable(false);
            $table->timestamp('created_at')->useCurrent();

            $table->foreign('referrer_id')->references('id')->on('referrers');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('referrer_clicks');
    }
}
