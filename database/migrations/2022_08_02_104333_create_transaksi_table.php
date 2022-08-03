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
        Schema::create('transaksi', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('pelanggan_id')->unsigned();
            $table->bigInteger('hargas_id')->unsigned();
            $table->string('invoice_no')->nullable()->default('text');
            $table->dateTime('date');
            $table->integer('tarif');
            $table->string('status');
            $table->timestamps();

        });

        Schema::table('transaksi', function (Blueprint $table) {    
            $table->foreign('pelanggan_id')->references('id')->on('pelanggan')
                ->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('hargas_id')->references('id')->on('hargas')
                ->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transaksi');
    }
};
