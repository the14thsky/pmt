<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
			$table->unsignedBigInteger('org_role_id');
			$table->unsignedBigInteger('department_id');
			$table->string('first_name');
			$table->string('last_name');
			$table->string('email')->unique();
			$table->string('password');
			$table->boolean('is_2fa')->default(false);
			$table->date('start_date');
			$table->date('end_date');
			$table->rememberToken();
			$table->timestamp('email_verified_at')->nullable();
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
        Schema::dropIfExists('users');
    }
}
