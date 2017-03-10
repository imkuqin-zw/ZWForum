<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTagsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tags', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->unique()->comment('标签名');
            $table->text('description')->nullable()->comment('标签描述');
            //$table->enum('is_blocked', ['yes',  'no'])->default('no')->index()->comment('禁止显示帖子');
            $table->enum('is_display', ['yes',  'no'])->default('no')->index()->comment('禁止显示标签');
            $table->integer('topic_count')->default(0)->index()->comment('帖子数');
            //$table->integer('order')->default(0)->index()->comment('排序');
            //$table->softDeletes();
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
        Schema::dropIfExists('tags');
    }
}
