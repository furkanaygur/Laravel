<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('cart_id')->unsigned()->unique();
            $table->decimal('price', 10, 4);
            $table->string('statu', 60)->nullable();
            $table->string('full_name', 60)->nullable();
            $table->string('address', 60)->nullable();
            $table->string('phone', 15)->nullable();
            $table->string('phone2', 15)->nullable();
            $table->string('bank', 100)->nullable();
            $table->string('installment', 100)->nullable();

            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP on UPDATE CURRENT_TIMESTAMP'));
            $table->timestamp('deleted_at')->nullable();

            $table->foreign('cart_id')->references('id')->on('cart')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
