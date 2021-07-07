<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectMiltestonesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('project_milestones', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('project_id');
            $table->string('milestone');
            $table->string('percentage');
            $table->float('amount');
            $table->boolean('can_invoice')->nullable()->default(false);
            $table->date('can_invoice_date')->nullable();
            $table->unsignedBigInteger('can_invoice_updated_by')->nullable();
            $table->boolean('invoice_sent')->nullable()->default(false);
            $table->date('invoice_sent_date')->nullable();
            $table->unsignedBigInteger('invoice_sent_updated_by')->nullable();
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
        Schema::dropIfExists('project_miltestones');
    }
}
