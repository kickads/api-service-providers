<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('opportunities', function (Blueprint $table) {
			$table->integer('id')->primary();
			$table->integer('carriers_id')->nullable();
			$table->decimal('rate', 11, 2)->nullable();
			$table->enum('model_adv', ['cpa', 'cpc', 'cpm', 'cpi', 'cpv', 'cpl', 'revenue share']);
			$table->string('product')->nullable();
			$table->integer('account_manager_id')->nullable();
			$table->text('comment')->nullable();
			$table->integer('country_id')->nullable();
			$table->tinyInteger('wifi')->nullable();
			$table->decimal('budget', 11, 2)->nullable();
			$table->string('server_to_server', 45)->default('ktoken');
			$table->timestamp('startDate')->nullable();
			$table->timestamp('endDate')->nullable();
			$table->integer('ios_id');
			$table->string('freq_cap', 45)->nullable();
			$table->integer('imp_per_day')->nullable();
			$table->integer('imp_total')->nullable();
			$table->string('targeting')->nullable();
			$table->string('sizes')->nullable();
			$table->enum('channel', ['categories', 'sites specifics', 'ron'])->nullable();
			$table->string('channel_description')->nullable();
			$table->enum('status', ['active', 'inactive', 'archived']);
			$table->integer('version');
			$table->boolean('closed_deal')->default(0);
			$table->decimal('close_amount', 11, 2)->default(0.00);
			$table->decimal('agency_commission', 11, 2)->default(0.00);
			$table->integer('sem_analyst_id')->nullable();
			$table->integer('commercial_id')->nullable();
			$table->string('comment_internal')->nullable();
			$table->enum('business_model', ['branding', 'performance', 'exchange', 'video'])->nullable();
			$table->string('pdf_client_order', 128)->nullable();
			$table->integer('deals_id')->nullable();
			$table->text('target_url')->nullable();
			$table->text('materials')->nullable();
			$table->string('placeholder_publisher', 45)->default('pub_id');
			$table->integer('goal_units')->default(0);
			$table->integer('devices_id')->nullable();
			$table->integer('actions_id')->nullable();
			$table->integer('formats_id')->nullable();
			$table->string('placeholder_source', 45)->nullable();
			$table->string('placeholder_device_id', 45)->nullable();
			$table->string('placeholder_gaid', 45)->nullable();
			$table->string('placeholder_idfa', 45)->nullable();
			$table->string('placeholder_provider_id', 45)->nullable();
			$table->decimal('cpm_client_price', 11, 2)->nullable();
			$table->decimal('cpm_floor_price_mow', 11, 2)->nullable();
			$table->boolean('receptivity')->default(0);
			$table->string('fee_tech', 45)->nullable();
			$table->string('ctr', 45)->nullable();
			$table->string('viewability', 45)->nullable();
			$table->string('url', 512)->nullable();
			$table->foreign('actions_id', 'fk_opportunities_actions1')->references('id')->on('actions')->onDelete('restrict')->onUpdate('restrict');
			$table->foreign('carriers_id', 'fk_opportunities_carriers')->references('id_carrier')->on('carriers')->onDelete('set NULL')->onUpdate('restrict');
			$table->foreign('country_id', 'fk_opportunities_country')->references('id_location')->on('geo_location')->onDelete('set NULL')->onUpdate('restrict');
			$table->foreign('deals_id', 'fk_opportunities_deals1')->references('id')->on('deals')->onDelete('restrict')->onUpdate('restrict');
			$table->foreign('devices_id', 'fk_opportunities_devices1')->references('id')->on('devices')->onDelete('restrict')->onUpdate('restrict');
			$table->foreign('formats_id', 'fk_opportunities_formats1')->references('id')->on('formats')->onDelete('restrict')->onUpdate('restrict');
			$table->foreign('ios_id', 'fk_opportunities_ios')->references('id')->on('ios')->onDelete('cascade')->onUpdate('restrict');
			$table->foreign('account_manager_id', 'fk_opportunities_users')->references('id')->on('users')->onDelete('set NULL')->onUpdate('restrict');
			$table->foreign('sem_analyst_id', 'fk_opportunities_users1')->references('id')->on('users')->onDelete('set NULL')->onUpdate('restrict');
			$table->foreign('commercial_id', 'fk_opportunities_users2')->references('id')->on('users')->onDelete('set NULL')->onUpdate('restrict');
		});
	}
	
	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('opportunities');
	}
};
