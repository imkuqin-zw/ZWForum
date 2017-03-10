<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTopicsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('topics', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title')->comment('标题');
            $table->text('content')->comment('内容');
            $table->integer('view_count')->unsigned()->default(0)->index()->comment('浏览数');
            $table->integer('vote_count')->default(0)->index()->comment('点赞数');
            $table->integer('reply_count')->default(0)->index()->comment('评论数');
            $table->integer('order')->default(0)->index()->comment('排序');
            $table->enum('is_top', ['yes',  'no'])->default('no')->index()->comment('是否置顶');
            $table->enum('is_excellent', ['yes',  'no'])->default('no')->index()->comment('是否精华文章');
            $table->enum('is_blocked', ['yes',  'no'])->default('no')->index()->comment('是否禁止');
            $table->unsignedInteger('category_id')->default(0)->index()->comment('分类id');
            $table->unsignedInteger('user_id')->index()->comment('用户id');
            $table->timestamp('reply_at')->comment('最新评论的时间');
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('category_id')->references('id')->on('categories')
                ->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('topics');
    }
}
