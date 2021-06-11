<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateModifiersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('modifiers', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid');
            $table->unsignedBigInteger('product_id');
            $table->unsignedBigInteger('modifier_item_id');
            $table->string('name');
            $table->string('description');
            $table->integer('max_qty')->default(1);
            $table->boolean('required')->nullable();
            $table->timestamps();

            $table->foreign('product_id')
                    ->references('id')
                    ->on('products')
                    ->onUpdate('cascade')
                    ->onDelete('cascade');

            $table->foreign('modifier_item_id')
                    ->references('id')
                    ->on('modifier_items')
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
        Schema::dropIfExists('modifiers');
    }
}
