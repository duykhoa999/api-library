<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBillBookTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bill_book', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('bill_id')->unsigned();
            $table->unsignedBigInteger('book_id')->unsigned();
            $table->integer('amount');
            $table->float('price');
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
        Schema::dropIfExists('bill_book');
    }
}
