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
            $table->boolean('published')->default(false);
            $table->unsignedBigInteger('team_id')->index();
            $table->string('alias', 15)->unique()->index();
            $table->text('details')->nullable();

            // begin sep-0001 properties
            // https://github.com/stellar/stellar-protocol/blob/master/ecosystem/sep-0001.md#account-information
            $table->string('federation_server')->nullable();
            $table->string('auth_server')->nullable();
            $table->string('transfer_server')->nullable();
            $table->string('kyc_server')->nullable();
            $table->string('web_auth_endpoint')->nullable();
            $table->unsignedBigInteger('signing_key_id')->nullable();
            $table->string('horizon_url')->nullable();
            // $table->string('accounts'); joined through organization_accounts table
            // $table->string('version'); hardcoded in the toml service
            $table->unsignedBigInteger('uri_request_signing_key_id')->nullable();
            // https://github.com/stellar/stellar-protocol/blob/master/ecosystem/sep-0001.md#issuer-documentation
            $table->string('name');
            $table->string('dba')->nullable();
            $table->string('url')->nullable();
            $table->string('logo')->nullable();
            $table->string('description')->nullable();
            $table->jsonb('address')->nullable();
            $table->string('address_attestation')->nullable();
            $table->jsonb('phone')->nullable()->nullable();;
            $table->string('phone_attestation')->nullable();
            $table->string('keybase')->nullable();
            $table->string('twitter')->nullable();
            $table->string('github')->nullable();
            $table->string('email')->nullable();
            $table->string('licensing_authority')->nullable();
            $table->string('license_type')->nullable();
            $table->string('license_number')->nullable();
            // end sep-0001 properties

            $table->timestamps();

            $table->foreign('team_id')->references('id')->on('teams');
            $table->foreign('signing_key_id')->references('id')->on('accounts');
            $table->foreign('uri_request_signing_key_id')->references('id')->on('accounts');
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
