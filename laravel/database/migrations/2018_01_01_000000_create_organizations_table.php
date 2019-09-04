<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrganizationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('organizations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->uuid('uuid');
            $table->string('slug', 15)->unique()->index();
            $table->boolean('published')->default(false);

            // begin sep-0001 properties
            // https://github.com/stellar/stellar-protocol/blob/master/ecosystem/sep-0001.md#issuer-documentation
            $table->string('name');
            $table->string('dba')->nullable();
            $table->string('url')->nullable();
            $table->string('logo')->nullable();
            $table->string('description')->nullable();
            $table->jsonb('physical_address')->nullable();
            $table->string('physical_address_attestation')->nullable();
            $table->jsonb('phone_number')->nullable();
            $table->string('phone_number_attestation')->nullable();
            $table->string('keybase')->nullable();
            $table->string('twitter')->nullable();
            $table->string('github')->nullable();
            $table->string('official_email')->nullable();
            $table->string('licensing_authority')->nullable();
            $table->string('license_type')->nullable();
            $table->string('license_number')->nullable();
            // end sep-0001 properties

            $table->text('details')->nullable();
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
        Schema::dropIfExists('organizations');
    }
}
