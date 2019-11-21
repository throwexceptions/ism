<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReceivablesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('receivables', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('supplier_id')->nullable();
            $table->string('container_no', 200)->nullable();
            $table->string('control_no', 200)->nullable();
            $table->string('po', 200)->nullable();
            $table->string('so', 200)->nullable();
            $table->string('delivery_advice', 200)->nullable();
            $table->dateTime('date_arrival')->nullable();
            $table->text('remarks')->nullable();
            $table->text('created_by')->nullable();
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
        Schema::dropIfExists('receivables');
    }
}
