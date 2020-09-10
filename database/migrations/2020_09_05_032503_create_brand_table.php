<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBrandTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('brand', function (Blueprint $table) {
//            $table->id();
//            $table->timestamps();
            $table->increments('brand_id')->comment('品牌id');
            $table->string('brand_name')->comment('品牌名称');
            $table->string('brand_url')->comment('品牌官方网址');
            $table->string('brand_logo')->comment('品牌logo');
            $table->string('brand_desc')->comment('品牌简介');
            $table->tinyInteger('is_del')->default(1)->comment('是否删除，1未删2已删');
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
        Schema::dropIfExists('brand');
    }
}
