<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOpportunitiesTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('opportunities', function (Blueprint $table) {
            $table->id();
            $table->integer('customer_id');
			$table->string('title');
            $table->json('contact_person_name');
            $table->json('contact_person_email');
            $table->json('contact_person_phone');
			$table->json('contact_person_remarks')->nullable();
            $table->longText('opportunity_description');
            $table->string('detailed_requirement');
            $table->string('estimated_budget');
            $table->string('chances');
            $table->string('status');
            $table->longText('remarks');
			$table->json('project_budget')->nullable();
			$table->json('payment_milestones')->nullable();
			$table->longText('invoicing_instruction')->nullable();
			$table->string('po_attachment')->nullable();
			$table->date('po_date')->nullable();
			$table->string('po_number')->nullable();
			$table->string('total_award_value')->nullable();
			$table->longText('reason_loosing_bid')->nullable();
			$table->unsignedBigInteger('created_by');
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
        Schema::drop('opportunities');
    }
}
