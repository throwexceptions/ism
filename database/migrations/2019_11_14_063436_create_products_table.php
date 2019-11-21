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
            $table->bigIncrements('id');
            $table->string('name', 200)->nullable();
            $table->string('size', 200)->nullable();
            $table->string('thickness', 200)->nullable();
            $table->string('color', 200)->nullable();
            $table->float('weight')->nullable();
            $table->string('pack_qty', 200)->nullable();
            $table->integer('quantity')->nullable();
            $table->string('type', 200)->nullable();
            $table->string('created_by', 200)->nullable();
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
