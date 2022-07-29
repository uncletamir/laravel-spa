<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDtManifestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dt__manifests', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('manifest_id');
            $table->bigInteger('inventory_id');
            $table->string('nama_inventory');
            $table->double('jumlah_inventory');
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
        Schema::dropIfExists('dt__manifests');
    }
}
