<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVendorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vendors', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name',200)->nullable();
            $table->string('acct_no',200)->nullable();
            $table->string('phone',200)->nullable();
            $table->string('other_phone',200)->nullable();
            $table->string('email',200)->nullable();
            $table->string('fax',200)->nullable();
            $table->string('website',200)->nullable();
            $table->string('assigned_to',200)->nullable();
            $table->string('parent_company',200)->nullable();
            $table->float('credit_limit')->nullable();
            $table->string('credit_available',200)->nullable();
            $table->string('payment_method',200)->nullable();
            $table->float('tax')->nullable();
            $table->text('tac')->nullable();
            $table->string('shipping_method',200)->nullable();
            $table->text('address')->nullable();
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
        Schema::dropIfExists('vendors');
    }
}
