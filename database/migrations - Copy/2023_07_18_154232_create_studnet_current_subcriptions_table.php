<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudnetCurrentSubcriptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('studnet_current_subcriptions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('student_name');
            $table->string('student_email');
            $table->string('student_roll_no');
            $table->string('mess_name');
            $table->string('plan_type')->nullable();
            $table->date('from_date');
            $table->date('to_date');
            $table->integer('status');
            $table->timestamps();
        });
    }

    
    
    public function down()
    {
        Schema::dropIfExists('studnet_current_subcriptions');
    }
}
