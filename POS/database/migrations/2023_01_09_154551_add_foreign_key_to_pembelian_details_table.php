<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pembelian_details', function (Blueprint $table) {
            $table->unsignedBigInteger('id_produk')->change();
            $table->foreign('id_produk')
                  ->references('id')
                  ->on('produks')
                  ->onUpdate('restrict')
                  ->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pembelian_details', function (Blueprint $table) {
            $table->integer('id_produk')->change();
            $table->dropforeign('pembelian_details_id_produk_foreign');
        });
    }
};
