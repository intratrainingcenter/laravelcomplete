<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRiwayattransaksisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('riwayattransaksis', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('datapelanggan_id')->unsigned();
            $table->foreign('datapelanggan_id')
            ->references('id')->on('datapelanggans')
            ->onDelete('cascade');
            $table->integer('qty');
            $table->float('totalharga', 8, 2);
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
        Schema::dropIfExists('riwayattransaksis');
    }
}
