<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('tenant_id');
            $table->unsignedBigInteger('form_payment_id');
            $table->unsignedBigInteger('deliveryman')->nullable();
            $table->unsignedBigInteger('seller')->nullable();
            $table->double('shipping', 10, 2)->default(0);
            $table->string('identify')->unique();
            $table->integer('client_id')->nullable();
            $table->integer('table_id')->nullable();
            $table->double('total', 10, 2);
            $table->double('total_discount', 10, 2)->default(0);
            $table->double('total_paid', 10, 2);
            $table->double('total_change', 10, 2)->default(0);
            $table->enum('status', ['open', 'done', 'rejected', 'working', 'canceled', 'delivering']);
            $table->text('comment')->nullable();
            $table->text('address')->nullable();
            $table->timestamps();

            $table->foreign('tenant_id')
                        ->references('id')
                        ->on('tenants')
                        ->onDelete('cascade');

            $table->foreign('form_payment_id')
                        ->references('id')
                        ->on('form_payments')
                        ->onDelete('cascade');
        });

        Schema::create('order_product', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('order_id');
            $table->unsignedBigInteger('product_id');
            $table->string('coupon')->nullable();
            $table->integer('qty');
            $table->double('price', 10, 2);
            $table->double('discount', 10, 2)->default(0);
            $table->double('paid', 10, 2);

            $table->foreign('order_id')
                        ->references('id')
                        ->on('orders')
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
        Schema::dropIfExists('order_product');
        Schema::dropIfExists('orders');
    }
}
