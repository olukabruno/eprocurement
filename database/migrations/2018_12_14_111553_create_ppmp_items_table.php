<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePpmpItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ppmp_items', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('code');
            $table->string('description',1000);
            $table->string('qty');
            $table->string('unit');
            $table->decimal('estimated_budget',15,2);
            $table->decimal('remaining_budget',15,2);
            $table->string('procurement_mode');
            $table->string('schedule');
            $table->integer('inventory');
            $table->integer('ppmp_id')->unsigned()->index()->nullable();
            
        });

        Schema::table('ppmp_items', function($table) {
            $table->foreign('ppmp_id')->references('id')->on('ppmps');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ppmp_items');
    }
}
