<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserJobTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('job_user', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->foreignId('job_id');
            $table->timestamps();

            $table->foreign("user_id")
                ->references('id')
                ->on("users")
                ->onDelete('cascade');

            $table->foreign("job_id")
                ->references('id')
                ->on("jobs")
                ->onDelete('cascade');

            $table->unique(['user_id', 'job_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_job');
    }
}
