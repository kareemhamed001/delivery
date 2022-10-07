<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
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

        DB::statement('CREATE OR REPLACE view this_month_finished_orders_view as SELECT * from orders where MONTH(delivery_time) = month(curdate()) and accepted=1 and finished=1 order by delivery_time desc');

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement('DROP VIEW this_month_finished_orders_view');
    }
};
