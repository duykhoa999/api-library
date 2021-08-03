<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TableBillBookRelation extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('bill_book', function (Blueprint $table) {
            $table->foreign('book_id')->references('id')
                ->on('books')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('bill_id')->references('id')
                ->on('bills')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('bill_book', function (Blueprint $table) {
            $table->dropForeign(['book_id']);
            $table->dropForeign(['bill_id']);
        });
    }
}
