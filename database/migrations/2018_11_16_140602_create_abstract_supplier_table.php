<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAbstractSupplierTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('abstract_supplier', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('abstract_id');
            $table->string('supplier');
            $table->string('supplier_address');
            $table->string('canvasser_name');
            $table->string('canvasser_department');
            $table->boolean('selected')->default(0);
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
        Schema::dropIfExists('abstract_supplier');
    }
}
