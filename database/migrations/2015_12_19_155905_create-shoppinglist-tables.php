<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateShoppinglistTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shops', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 100)->index();
            $table->integer('address_id')->unsigned();
            $table->timestamps();
        });

        Schema::create('categories', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 100)->index();
            $table->timestamps();
        });

        Schema::create('units', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->index();
            $table->string('code', 10)->index();
            $table->integer('single_amount');
            $table->timestamps();
        });

        Schema::create('countries', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('code');
            $table->timestamps();
        });

        Schema::create('purchasings', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('shop_id')->index()->unsigned();
            $table->integer('user_id')->index()->unsigned();
            $table->date('bought_at');
            $table->double('total_amount', 15, 2);
            $table->timestamps();

            $table->foreign('shop_id')->references('id')->on('shops')->onUpdate('cascade')->onDelete('cascade');
        });

        Schema::create('addresses', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('country_id')->unsigned();
            $table->string('city', 100);
            $table->timestamps();

            $table->foreign('country_id')->references('id')->on('countries')->onUpdate('cascade')->onDelete('cascade');
        });

        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 100)->index();
            $table->integer('unit_id')->unsigned();
            $table->timestamps();

            $table->foreign('unit_id')->references('id')->on('units')->onUpdate('cascade')->onDelete('cascade');
        });


        /**
         * Kreuztabellen
         *
         */
        Schema::create('product_category', function (Blueprint $table) {
            $table->integer('product_id')->unsigned()->index();
            $table->integer('category_id')->unsigned()->index();

            $table->foreign('product_id')->references('id')->on('products')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('category_id')->references('id')->on('categories')->onUpdate('cascade')->onDelete('cascade');

            $table->primary(['product_id', 'category_id']);
        });

        Schema::create('purchase_product', function (Blueprint $table) {
            $table->integer('purchase_id')->unsigned()->index();
            $table->integer('product_id')->unsigned()->index();
            $table->integer('amount');
            $table->double('single_price');

            $table->foreign('purchase_id')->references('id')->on('purchasings')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('product_id')->references('id')->on('products')->onUpdate('cascade')->onDelete('cascade');

            $table->primary(['purchase_id', 'product_id']);
        });

        Schema::create('product_details', function (Blueprint $table) {
            $table->integer('id', false, true)->index();
            $table->integer('shop_id')->unsigned()->index();
            $table->integer('product_id')->unsigned()->index();
            $table->double('single_price', 15, 2);
            $table->date('used_at');
            $table->timestamps();

            $table->foreign('shop_id')->references('id')->on('shops')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('product_id')->references('id')->on('products')->onUpdate('cascade')->onDelete('cascade');

            //$table->primary(['id', 'shop_id', 'product_id']);
        });

        DB::statement("ALTER TABLE product_details ADD PRIMARY KEY (shop_id, product_id);");
        DB::statement("ALTER TABLE product_details MODIFY id int(10) AUTO_INCREMENT;");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('product_shop');
        Schema::drop('product_unit');
        Schema::drop('product_category');
        Schema::drop('purchase_product');
        Schema::drop('products');
        Schema::drop('addresses');
        Schema::drop('purchasings');
        Schema::drop('countries');
        Schema::drop('units');
        Schema::drop('categories');
        Schema::drop('shops');
    }
}
