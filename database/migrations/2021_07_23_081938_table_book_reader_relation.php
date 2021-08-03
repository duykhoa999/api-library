<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TableBookReaderRelation extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('book_reader', function (Blueprint $table) {
            $table->foreign('book_id')->references('id')
                ->on('books')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('reader_id')->references('id')
                ->on('readers')
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
        Schema::table('book_reader', function (Blueprint $table) {
            $table->dropForeign(['book_id']);
            $table->dropForeign(['reader_id']);
        });
    }
}
