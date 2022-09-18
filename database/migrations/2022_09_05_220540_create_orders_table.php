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
            $table->string('hashed_id')->nullable();
            $table->unsignedBigInteger('user_id');
            $table->string('name');
            $table->string('description',255);
            $table->string('from_address',255);
            $table->string('to_address',255);
            $table->text('notes')->nullable();
            $table->string('price')->nullable();
            $table->unsignedBigInteger('accepted_by')->nullable();
            $table->unsignedBigInteger('finished_by')->nullable();
            $table->tinyInteger('accepted')->default(0);
            $table->tinyInteger('finished')->default(0);
            $table->tinyInteger('canceled')->default(0);
            $table->string('failure_reason')->nullable();
            $table->dateTime('delivery_time');

            $table->timestamps();

            $table->foreign('user_id')->references('users')->on('id')->nullOnDelete();
            $table->foreign('accepted_by')->references('users')->on('id')->nullOnDelete();
            $table->foreign('finished_by')->references('users')->on('id')->nullOnDelete();

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
