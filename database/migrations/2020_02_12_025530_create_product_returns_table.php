<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductReturnsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_returns', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('customer_id')->nullable();
            $table->string('sales_order_id')->nullable();
            $table->string('pr_no')->nullable();
            $table->string('return_type')->nullable();
            $table->string('contact_person')->nullable();
            $table->text('reason')->nullable();
            $table->text('remarks')->nullable();
            $table->string('assigned_to')->nullable();
            $table->timestamps();
        });

        Schema::table('product_details', function (Blueprint $table) {
            $table->string('product_return_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_returns');
    }
}
