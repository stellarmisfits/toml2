<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrganizationAssetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('organization_assets', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('organization_id');
            $table->unsignedBigInteger('asset_id');
            $table->timestamps();

            $table->unique(['asset_id']);
            $table->foreign('asset_id')->references('id')->on('assets');
            $table->foreign('organization_id')->references('id')->on('organizations');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('organization_accounts');
    }
}
