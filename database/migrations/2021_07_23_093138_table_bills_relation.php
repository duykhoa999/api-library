<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TableBillsRelation extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('bills', function (Blueprint $table) {
            $table->foreign('company_id')->references('id')
            ->on('companies')
            ->onDelete('cascade')
            ->onUpdate('cascade');

            $table->foreign('type_id')->references('id')
            ->on('types')
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
        Schema::table('bills', function (Blueprint $table) {
            $table->dropForeign(['company_id']);
            $table->dropForeign(['type_id']);
        });
    }
}
