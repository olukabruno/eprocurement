<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRfqTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rfq', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('pr_number');
            $table->string('department');
            $table->string('purpose');
            $table->unsignedInteger('created_by');
            $table->boolean('status')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rfq');
    }
}
