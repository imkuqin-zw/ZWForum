<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRepliesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('replies', function (Blueprint $table) {
            $table->increments('id');
            $table->text('content')->comment('评论内容');
//            $table->unsignedInteger('parent_id')->default(0)->comment('父评论id');
            $table->enum('is_blocked', ['yes',  'no'])->default('no')->index()->comment('禁止显示评论');
            $table->unsignedInteger('topic_id')->index()->comment('帖子id');
            $table->unsignedInteger('user_id')->index()->comment('用户id');
            //$table->softDeletes();
            $table->timestamps();

//            $table->foreign('parent_id')->references('id')->on('categories')
//                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('topic_id')->references('id')->on('topics')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')
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
        Schema::dropIfExists('replies');
    }
}
