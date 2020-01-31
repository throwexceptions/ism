<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnGrandTotalUserPositionVatType extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('position')->nullable();
        });

        Schema::table('summaries', function (Blueprint $table) {
            $table->string('grand_total')->nullable();
        });
        
        Schema::table('purchase_infos', function (Blueprint $table) {
            $table->string('vat_type')->nullable();
            $table->string('payment_status')->nullable();
        });

        Schema::table('sales_orders', function (Blueprint $table) {
            $table->string('vat_type')->nullable();
            $table->string('payment_status')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
