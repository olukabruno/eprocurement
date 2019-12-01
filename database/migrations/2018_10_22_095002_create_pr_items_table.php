<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePrItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pr_items', function (Blueprint $table) {
            $table->increments('id');
            $table->string('pr_form_number');
            $table->string('pr_qty');
            $table->string('pr_unit');
            $table->string('pr_description', 1000);
            $table->decimal('pr_cost_per_unit',15,2);
            $table->decimal('pr_estimated_cost',15,2);
            $table->integer('pr_id')->unsigned()->index()->nullable();
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
        Schema::dropIfExists('pr_items');
    }
}
