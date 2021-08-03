<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->integer('year')->unsigned();
            $table->string('image');
            $table->string('language');
            $table->string('pagesNum');
            $table->string('description')->nullable()->default(null);
            $table->unsignedBigInteger('category_id')->unsigned();
            $table->unsignedBigInteger('publisher_id')->unsigned();
            $table->unsignedBigInteger('author_id')->unsigned();
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
        Schema::dropIfExists('books');
    }
}
