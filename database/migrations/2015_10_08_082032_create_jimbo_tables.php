<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJimboTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coupons', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('client_id', 10);
            $table->string('campaign_id', 32);
            //$table->string('mail_chimp_list_id', 10);
            $table->string('tcc_id', 255);
            $table->date('pet_dob')->nullable();
            $table->string('fname',64);
            $table->string('lname',64);
            $table->string('email',64);
            $table->timestamp('added_on')->default(DB::raw('CURRENT_TIMESTAMP'));
            //$table->date('downloding_link_date')->nullable();
            //$table->string('type',16);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('coupons');
    }
}
