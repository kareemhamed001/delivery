<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
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
            $table->unsignedBigInteger('user_id');
            $table->string('name');
            $table->string('description');
            $table->string('from_address');
            $table->string('to_address');
            $table->text('notes')->nullable();
            $table->tinyInteger('accepted')->default(0);
            $table->tinyInteger('finished')->default(0);
            $table->date('date');
            $table->time('time');
            $table->unsignedBigInteger('accepted_by')->nullable();
            $table->unsignedBigInteger('finished_by')->nullable();
            $table->timestamps();

            $table->foreign('user_id')->references('users')->on('id')->cascadeOnDelete();
            $table->foreign('accepted_by')->references('users')->on('id')->cascadeOnDelete();
            $table->foreign('finished_by')->references('users')->on('id')->cascadeOnDelete();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
};
