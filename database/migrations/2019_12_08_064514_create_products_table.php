<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->string('manual_id',200)->nullable();
            $table->string('name', 999)->nullable();
            $table->string('code',200)->nullable();
            $table->string('category',200)->nullable();
            $table->string('manufacturer', 200)->nullable();
            $table->float('selling_price')->nullable();
            $table->float('vendor_price')->nullable();
            $table->string('unit', 200)->nullable();
            $table->text('description')->nullable();
            $table->string('batch', 200)->nullable();
            $table->string('color',200)->nullable();
            $table->float('size')->nullable();
            $table->float('weight')->nullable();
            $table->string('type')->nullable();
            $table->string('assigned_to', 200)->nullable();
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
        Schema::dropIfExists('products');
    }
}
