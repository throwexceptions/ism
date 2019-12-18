<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePurchaseInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchase_infos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('subject', 200)->nullable();
            $table->string('vendor_id', 200)->nullable();
            $table->string('requisition_no', 200)->nullable();
            $table->string('tracking_number', 200)->nullable();
            $table->string('contact_name', 200)->nullable();
            $table->string('phone', 200)->nullable();
            $table->string('due_date', 200)->nullable();
            $table->string('fax', 200)->nullable();
            $table->string('carrier', 200)->nullable();
            $table->string('deliver_to', 200)->nullable();
            $table->string('shipping_method', 200)->nullable();
            $table->string('assigned_to', 200)->nullable();
            $table->string('status', 200)->nullable();
            $table->date('date_received')->nullable();
            $table->string('po_no', 200)->nullable();
            $table->string('payment_method', 200)->nullable();
            $table->text('billing_address')->nullable();
            $table->string('check_number')->nullable();
            $table->string('check_writer')->nullable();
            $table->text('delivery_address')->nullable();
            $table->text('tac')->nullable();
            $table->text('description')->nullable();
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
        Schema::dropIfExists('purchase_infos');
    }
}
