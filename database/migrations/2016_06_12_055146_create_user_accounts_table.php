<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_accounts', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->string('qq',20)->nullable();
            $table->string('weixin',100)->nullable();
            $table->string('weibo',100)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('user_accounts');
    }
}
