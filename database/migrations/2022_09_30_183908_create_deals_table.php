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
		Schema::create('deals', function (Blueprint $table) {
			$table->integer('id')->primary();
			$table->string('agency', 45)->nullable();
			$table->integer('advertisers_id');
			$table->integer('country_id')->nullable();
			$table->integer('carriers_id')->nullable();
			$table->integer('users_id');
			$table->integer('campaign_categories_id');
			$table->integer('devices_id')->nullable();
			$table->integer('formats_id')->nullable();
			$table->integer('actions_id')->nullable();
			$table->enum('currency', ['usd', 'ars', 'eur', 'gbp', 'brl', 'mxn', 'clp', 'cop']);
			$table->timestamp('start_date')->useCurrent();
			$table->timestamp('end_date')->nullable();
			$table->string('goal');
			$table->enum('business_model', ['branding', 'performance', 'exchange', 'branding development', 'augmented reality', 'move pmp']);
			$table->decimal('budget', 11, 2)->nullable();
			$table->decimal('agency_commission', 11, 2)->default(0.00);
			$table->enum('model_adv', ['cpa', 'cpc', 'cpm', 'cpi', 'cpv', 'cpl'])->default('CPM');
			$table->string('conversion_flow', 70)->nullable();
			$table->boolean('wifi')->default(0);
			$table->text('dayparting')->nullable();
			$table->text('campaigns_restrictions')->nullable();
			$table->string('adserver', 70)->nullable();
			$table->string('net_payment', 128);
			$table->string('contact_com', 128);
			$table->string('email_com', 128);
			$table->string('contact_adm', 128);
			$table->string('email_adm', 128);
			$table->text('comment')->nullable();
			$table->text('inventory_conditions')->nullable();
			$table->enum('entity', ['llc', 'srl', 'bvi', 'mx', 'sa', 'sas'])->comment("0: LLC, 1: SRL");
			$table->string('external_operation', 45)->nullable();
			$table->decimal('rate', 11, 2)->nullable();
			$table->timestamp('date')->nullable();
			$table->enum('status', ['active', 'pending', 'approved', 'rejected', 'archived'])->default('Active');
			$table->string('flow', 45)->nullable();
			$table->string('commercial_name', 128);
			$table->string('address', 128);
			$table->string('zip_code', 128);
			$table->string('tax_id', 128)->comment("0:CPA,1:CPC,2:CPM,2:CPL");
			$table->integer('ios_id')->nullable();
			$table->string('state', 128);
			$table->string('pdf_name', 128)->nullable();
			$table->string('phone', 128)->nullable();
			$table->string('product')->nullable();
			$table->string('freq_cap', 45)->nullable();
			$table->integer('imp_per_day')->nullable();
			$table->integer('imp_total')->nullable();
			$table->string('targeting')->nullable();
			$table->string('sizes')->nullable();
			$table->enum('channel', ['categories', 'sites specifics', 'ron'])->nullable();
			$table->string('channel_description')->nullable();
			$table->integer('sales_id');
			$table->decimal('media_buying_perc', 11, 2)->default(0.00);
			$table->decimal('exchange_rate', 11, 3)->default(0.000);
			$table->enum('created_by_sector', ['client services', 'sales'])->nullable();
			$table->enum('provider_type', ['affiliate', 'network'])->nullable();
			$table->integer('goal_units')->default(0);
			$table->boolean('client_report')->default(0);
			$table->integer('version');
			$table->string('version_comment', 45);
			$table->enum('priority', ['low', 'medium', 'high', 'urgent'])->default('Low');
			$table->boolean('telecom')->default(0);
			$table->integer('agency_fee')->nullable();
			$table->enum('tracking_method', ['s2s', 'pixel'])->nullable();
			$table->string('pdf_name2', 128)->nullable();
			$table->string('seat_id')->nullable();
			$table->enum('materials_development', ['kickads', 'client'])->default('Client');
			$table->integer('dsp_id')->nullable();
			$table->enum('materials_upload', ['kickads', 'client'])->default('Client');
			$table->string('other_dsp')->nullable();
			$table->string('vertical')->nullable();
			$table->foreign('actions_id', 'fk_deals_actions1')->references('id')->on('actions')->onDelete('restrict')->onUpdate('restrict');
			$table->foreign('advertisers_id', 'fk_deals_advertisers1')->references('id')->on('advertisers')->onDelete('restrict')->onUpdate('restrict');
			$table->foreign('campaign_categories_id', 'fk_deals_campaign_categories1')->references('id')->on('campaign_categories')->onDelete('restrict')->onUpdate('restrict');
			$table->foreign('carriers_id', 'fk_deals_carriers1')->references('id_carrier')->on('carriers')->onDelete('restrict')->onUpdate('restrict');
			$table->foreign('devices_id', 'fk_deals_devices1')->references('id')->on('devices')->onDelete('restrict')->onUpdate('restrict');
			$table->foreign('dsp_id', 'fk_deals_dsp1')->references('id')->on('dsp')->onDelete('restrict')->onUpdate('restrict');
			$table->foreign('formats_id', 'fk_deals_formats1')->references('id')->on('formats')->onDelete('restrict')->onUpdate('restrict');
			$table->foreign('country_id', 'fk_deals_geo_location1')->references('id_location')->on('geo_location')->onDelete('restrict')->onUpdate('restrict');
			$table->foreign('ios_id', 'fk_deals_ios1')->references('id')->on('ios')->onDelete('restrict')->onUpdate('restrict');
			$table->foreign('users_id', 'fk_deals_users1')->references('id')->on('users')->onDelete('restrict')->onUpdate('restrict');
			$table->foreign('sales_id', 'fk_deals_users2')->references('id')->on('users')->onDelete('restrict')->onUpdate('restrict');
		});
	}
	
	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('deals');
	}
};
