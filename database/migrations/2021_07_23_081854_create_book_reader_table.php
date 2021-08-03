<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookReaderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('book_reader', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('book_id')->unsigned();
            $table->unsignedBigInteger('reader_id')->unsigned();
            $table->datetime('borrowDate');
            $table->datetime('returnDate');
            $table->boolean('status')->nullable()->default(false);
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
        Schema::dropIfExists('book_reader');
    }
}
