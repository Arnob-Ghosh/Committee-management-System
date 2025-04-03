<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExpensiveAmountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('expensive_amounts', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('mode');
            $table->unsignedInteger('cash_in')->nullanle();
            $table->unsignedInteger('cash_out')->nullable();
            $table->string('remark')->nullable();
            $table->string('entry_by');
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
        Schema::dropIfExists('expensive_amounts');
    }
}
