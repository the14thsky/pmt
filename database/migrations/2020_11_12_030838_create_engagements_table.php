<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEngagementsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('engagements', function (Blueprint $table) {
			$table->id();
            $table->integer('customer_id');
            $table->integer('opportunity_id');
            $table->string('type');
            $table->longText('brief_description')->nullable();
            $table->string('attachment')->nullable();
            $table->string('follow_up');
            $table->longText('action_item')->nullable();
            $table->date('dateline');
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
        Schema::drop('engagements');
    }
}
