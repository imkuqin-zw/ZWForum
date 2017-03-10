<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumns2ToUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('portrait_min')->nullable()->comment('小头像路径');
            $table->string('portrait_mid')->nullable()->comment('中头像路径');
            $table->string('portrait_max')->nullable()->comment('大头像路径');
            $table->string('github_name')->nullable()->comment('github名');
            $table->string('real_name')->nullable()->comment('真实姓名');
            $table->string('city')->nullable()->comment('城市');
            $table->string('company')->nullable()->comment('公司');
            $table->string('weibo_name')->nullable()->comment('微博用户名');
            $table->string('weibo_link')->nullable()->comment('微博个人页面');
            $table->string('twitter_account')->nullable()->comment('Twitter 帐号');
            $table->string('personal_website')->nullable()->comment('个人网站');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('portrait_min');
            $table->dropColumn('portrait_mid');
            $table->dropColumn('portrait_max');
            $table->dropColumn('github_name');
            $table->dropColumn('real_name');
            $table->dropColumn('city');
            $table->dropColumn('company');
            $table->dropColumn('weibo_name');
            $table->dropColumn('weibo_link');
            $table->dropColumn('twitter_account');
            $table->dropColumn('personal_website');
        });
    }
}
