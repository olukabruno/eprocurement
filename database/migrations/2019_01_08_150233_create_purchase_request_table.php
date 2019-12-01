<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePurchaseRequestTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       Schema::create('purchase_request', function (Blueprint $table) {
            $table->increments('id');
            $table->string('pr_unique');
            $table->string('pr_form_no');
            $table->string('prev_pr')->nullable();
            $table->string('department');
            $table->string('section')->nullable();
            $table->string('purpose');
            $table->string('requestor_name');
            $table->string('requestor_position');
            $table->string('supplier_type'); 
            $table->string('supplier_name')->nullable();
            $table->string('supplier_address')->nullable();           
            $table->string('status');
            $table->boolean('created_supplemental')->default(0);
            $table->boolean('is_supplemental')->default(0);
            $table->boolean('created_rfq')->default(0);
            $table->boolean('created_abstract')->default(0);
            $table->boolean('created_po')->default(0);
            $table->boolean('created_inspection')->default(0);
            $table->unsignedInteger('created_by');
            $table->integer('ppmp_id')->unsigned()->index()->nullable();
            $table->decimal('budget_alloc',15,2);
            $table->timestamps();
        });

        Schema::table('purchase_request', function (Blueprint $table) {
            $table->foreign('ppmp_id')->references('id')->on('ppmps');
        });

        Schema::table('pr_items', function($table) {
            $table->foreign('pr_id')->references('id')->on('purchase_request');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('purchase_request');
    }
}
