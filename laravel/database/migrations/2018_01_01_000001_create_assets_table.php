<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAssetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assets', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->uuid('uuid');
            $table->unsignedBigInteger('team_id');
            $table->unsignedBigInteger('account_id');
            $table->boolean('published')->default(false);

            $table->string('code');
            $table->string('code_template')->nullable();
            $table->string('name')->nullable();
            // $table->string('issuer'); // obtain through account_id
            $table->string('status')->nullable();
            $table->integer('display_decimals')->default(0);
            $table->string('desc')->nullable();
            $table->text('conditions')->nullable();
            // $table->string('image'); // obtain through media library
            $table->string('fixed_number')->nullable();
            $table->string('max_number')->nullable();
            $table->boolean('is_unlimited')->nullable()->default(false);
            $table->boolean('is_asset_anchored')->nullable()->default(false);
            $table->string('anchor_asset_type')->nullable();
            $table->string('anchor_asset')->nullable();
            $table->string('redemption_instructions')->nullable();
            $table->string('collateral_addresses')->nullable();
            $table->string('collateral_address_messages')->nullable();
            $table->string('collateral_address_signatures')->nullable();
            $table->string('regulated')->nullable();
            $table->string('approval_server')->nullable();
            $table->string('approval_criteria')->nullable();

            $table->timestamps();

            $table->unique('code');
            $table->index('code');
            $table->index('account_id');
            $table->foreign('team_id')->references('id')->on('teams')->onDelete('cascade');
            $table->foreign('account_id')->references('id')->on('accounts')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('assets');
    }
}
