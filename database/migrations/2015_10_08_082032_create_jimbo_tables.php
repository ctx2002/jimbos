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
        Schema::create('mail_chimp', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('mail_chimp_data_id', 10);
            $table->string('mail_chimp_list_id', 10);
            $table->timestamp('added_on')->default(DB::raw('CURRENT_TIMESTAMP'));
        });
        
        Schema::create('tcc', function(Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');			
            $table->integer('tcc_id')->unsigned()->default(0);
            $table->integer('mail_chimp_id')->length(10)->unsigned();
            $table->foreign('mail_chimp_id')->references('id')->on('mail_chimp')->onDelete('cascade');					
            $table->timestamp('added_on')->default(DB::raw('CURRENT_TIMESTAMP'));		
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('tcc');
        Schema::drop('mail_chimp');
    }
}
