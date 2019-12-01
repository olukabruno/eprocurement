<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInspectionReportTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inspection_report', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('supplier');
            $table->unsignedInteger('po_no');
            $table->string('po_date');
            $table->string('pr_number');
            $table->string('requisitioning_office');
            $table->string('property_officer');
            $table->string('inspection_officer');
            $table->string('invoice_no')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('inspection_report');
    }
}
