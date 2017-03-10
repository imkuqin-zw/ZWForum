<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->unique()->comment('分类名');
            $table->text('description')->nullable()->comment('分类描述');
            //$table->unsignedInteger('parent_id')->default(0)->comment('父分类id');
            $table->enum('is_blocked', ['yes',  'no'])->default('no')->index()->comment('禁止显示帖子');
            $table->enum('is_display', ['yes',  'no'])->default('no')->index()->comment('禁止显示分类');
            $table->integer('topic_count')->default(0)->index()->comment('帖子数');
            $table->integer('order')->default(0)->index()->comment('排序');
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
        Schema::dropIfExists('categories');
    }
}
