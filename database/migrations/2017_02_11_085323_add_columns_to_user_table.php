<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnsToUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->enum('is_admin',['yes','no'])->default('no')->index()->comment('是否管理员');
            $table->string('description')->nullable()->comment('个性签名');
            $table->integer('topic_count')->default(0)->comment('帖子数');
            $table->integer('follower_count')->default(0)->comment('被关注数');
            $table->integer('reply_count')->default(0)->comment('评论数字');
            $table->enum('is_banned',['yes','no'])->default('no')->comment('是否禁止用户');
            $table->integer('github_id')->index()->comment('github账号ID');
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
            $table->dropColumn('is_admin');
            $table->dropColumn('github_id');
            $table->dropColumn('description');
            $table->dropColumn('topic_count');
            $table->dropColumn('follower_count');
            $table->dropColumn('reply_count');
            $table->dropColumn('is_banned');
        });
    }
}
