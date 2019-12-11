<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSalesOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales_orders', function (Blueprint $table) {
            $table->increments('id');
            $table->string('subject', 200)->nullable();
            $table->integer('customer_id')->nullable();
            $table->string('so_no', 200)->nullable();
            $table->string('owner', 200)->nullable();
            $table->string('agent', 200)->nullable();
            $table->string('assigned_to', 200)->nullable();
            $table->string('status', 200)->nullable();
            $table->string('phone', 200)->nullable();
            $table->string('fax', 200)->nullable();
            $table->string('email', 200)->nullable();
            $table->string('address', 200)->nullable();
            $table->string('due_date', 200)->nullable();
            $table->string('payment_method', 200)->nullable();
            $table->string('account_name', 200)->nullable();
            $table->string('account_no', 200)->nullable();
            $table->string('tac', 200)->nullable();
            $table->softDeletes();
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
        Schema::dropIfExists('sales_orders');
    }
}
