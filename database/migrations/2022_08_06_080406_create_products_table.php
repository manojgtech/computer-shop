<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug');
            $table->string('sku')->nullable();
            $table->integer('category_id');
            $table->integer('brand_id');
            $table->integer('series_id')->nullable();
            $table->string('regular_price');
            $table->integer('discount');
            $table->integer('stock');
            $table->string('sell_price');
            $table->longText('description');
            $table->text('short_description');
            $table->string('meta_description');
            $table->string('warranty');
            $table->enum('status',[0,1])->default(0);
            $table->enum('featured',[0,1])->default(0);
            $table->enum('bestseller',[0,1])->default(0);
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
        Schema::dropIfExists('products');
    }
}
