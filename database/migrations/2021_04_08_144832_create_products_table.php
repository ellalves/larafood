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
            $table->unsignedBigInteger('tenant_id');
            $table->unsignedBigInteger('provider_id')->nullable();
            $table->uuid('uuid');
            $table->string('title');
            $table->string('url');
            $table->string('image')->nullable();
            $table->double('quantity', 10, 2)->default(1);
            $table->double('min_quantity', 10, 2)->default(0);
            $table->double('lucre', 10, 2)->nullable();
            $table->double('cost_price', 10, 2)->nullable();
            $table->double('price', 10, 2);
            $table->string('description')->nullable();
            $table->timestamps();

            $table->foreign('tenant_id')
                    ->references('id')
                    ->on('tenants')
                    ->onUpdate('cascade')
                    ->onDelete('cascade');
        });

        Schema::create('category_product', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('category_id');
            $table->unsignedBigInteger('product_id');

            $table->foreign('category_id')
                    ->references('id')
                    ->on('categories')
                    ->onDelete('cascade');
            $table->foreign('product_id')
                    ->references('id')
                    ->on('products')
                    ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('category_product');
        Schema::dropIfExists('products');
    }
}
