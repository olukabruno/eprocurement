<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePpmpsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ppmps', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->year('ppmp_year');
            $table->decimal('estimated_budget',15,2)->default(0)->nullable();
            $table->decimal('remaining_budget',15,2)->default(0)->nullable();
            $table->string('department');
            $table->boolean('is_activated')->default(0);
            $table->integer('user_id')->unsigned()->index()->nullable();
        });

        Schema::table('ppmps', function($table) {
            $table->softDeletes();
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ppmps');
    }
}
