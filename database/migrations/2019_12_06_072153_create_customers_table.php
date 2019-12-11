<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('acc_name',200)->nullable();
            $table->string('phone',200)->nullable();
            $table->string('other_phone',200)->nullable();
            $table->string('email',200)->nullable();
            $table->string('parent_company',200)->nullable();
            $table->string('acc_no',200)->nullable();
            $table->string('website',200)->nullable();
            $table->string('fax',200)->nullable();
            $table->integer('employees')->nullable();
            $table->text('ownership')->nullable();
            $table->string('industry',200)->nullable();
            $table->string('sales_manager',200)->nullable();
            $table->string('assigned_to',200)->nullable();
            $table->string('sales_person',200)->nullable();
            $table->string('acc_status',200)->nullable();
            $table->string('tax_id',200)->nullable();
            $table->string('reseller_id',200)->nullable();
            $table->string('payment_method',200)->nullable();
            $table->text('tac')->nullable();
            $table->text('address')->nullable();
            $table->text('description')->nullable();
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
        Schema::dropIfExists('customers');
    }
}
