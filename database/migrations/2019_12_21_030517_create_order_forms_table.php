<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderFormsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_forms', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('customer_id', 200)->nullable();
            $table->string('acct_exec', 200)->nullable();
            $table->string('no', 200)->nullable();
            $table->string('so_no', 200)->nullable();
            $table->string('po_no', 200)->nullable();
            $table->string('prepared_by', 200)->nullable();
            $table->string('stock_card_in', 200)->nullable();
            $table->string('plate_no', 200)->nullable();
            $table->string('driver', 200)->nullable();
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
        Schema::dropIfExists('order_forms');
    }
}
