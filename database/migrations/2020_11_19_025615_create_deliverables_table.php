<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDeliverablesTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('deliverables', function (Blueprint $table) {
			$table->id();
            $table->integer('project_id');
            $table->string('title');
            $table->string('task');
            $table->string('party');
            $table->string('predecessor');
            $table->string('budget_group');
            $table->integer('duration');
            $table->date('start_date');
            $table->date('end_date');
            $table->string('status');
            $table->integer('man_hours');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('deliverables');
    }
}
