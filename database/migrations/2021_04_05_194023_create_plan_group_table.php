<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlanGroupTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('plan_group', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('plan_id');
            $table->unsignedBigInteger('group_id');
            $table->foreign('plan_id')
                    ->references('id')
                    ->on('plans')
                    ->onDelete('cascade');
            $table->foreign('group_id')
                    ->references('id')
                    ->on('groups')
                    ->onDelete('cascade');
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
        Schema::dropIfExists('plan_group');
    }
}
