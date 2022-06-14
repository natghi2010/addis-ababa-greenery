<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string("name");
            $table->text("description");
            $table->foreignId("project_type_id")->refrences("id")->on("project_types");
            $table->foreignId("team_leader_id")->refrences("id")->on("users")->default(0);
            $table->foreignId("subcity_id")->refrences("id")->on("subcities")->default(0);
            $table->date("start_date");
            $table->date("end_date")->nullable();
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
        Schema::dropIfExists('projects');
    }
}
