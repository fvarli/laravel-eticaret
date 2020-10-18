<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductOrderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_order', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('box_id')->unsigned();
            $table->decimal('order_price', 10,4);
            $table->string('status',30)->nullable();
            $table->string('full_name', 50)->nullable();
            $table->string('address', 50)->nullable();
            $table->string('phone', 50)->nullable();
            $table->string('cell_phone', 50)->nullable();
            $table->string('bank', 20)->nullable();
            $table->integer('installment')->nullable();
            $table->softDeletes();
            $table->timestamps();
            $table->unique('box_id');
            $table->foreign('box_id')->references('id')->on('box')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_order');
    }
}
