<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExperienceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('experience', function (Blueprint $table) {
            $table->id();
            $table->string('position', 50);
            $table->string('company_name');
            $table->text('description')->nullable(true);
            $table->date('start');
            $table->date('end')->nullable();
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
        Schema::dropIfExists('experience');
    }
}
