<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCouponsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coupons', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('tenant_id');
            $table->string('name');
            $table->string('url');
            $table->string('description')->nullable();
            $table->string('uuid')->unique();
            $table->decimal('discount', 6, 2)->default(0);
            $table->enum('discount_mode', ['price', 'percentage'])->default('percentage');
            $table->decimal('limit', 6, 2)->default(0);
            $table->enum('limit_mode', ['price', 'quantity'])->default('quantity');
            $table->dateTime('start_validity');
            $table->dateTime('end_validity');
            $table->enum('active', ['yes', 'no'])->default('yes');            
            $table->timestamps();

            $table->foreign('tenant_id')
                    ->references('id')
                    ->on('tenants')
                    ->onUpdate('cascade')
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
        Schema::dropIfExists('coupons');
    }
}
