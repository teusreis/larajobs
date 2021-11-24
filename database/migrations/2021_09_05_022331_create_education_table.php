<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEducationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('education', function (Blueprint $table) {
            $table->id();
            $table->integer('level');
            $table->string('course_name');
            $table->string('institution_name');
            $table->boolean('stillCoursing')->default(false);
            $table->date('start_date');
            $table->date('end_date')->nullable();
            $table->foreignId('resume_id');
            $table->timestamps();

            $table->foreign('resume_id')
                ->references('id')
                ->on('resume')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('education');
    }
}
