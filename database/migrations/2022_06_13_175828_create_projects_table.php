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
            $table->string("cover_image")->nullable();
            $table->foreignId("project_type_id")->refrences("id")->on("project_types");
            $table->foreignId("team_leader_id")->refrences("id")->on("users")->default(0);
            $table->foreignId("subcity_id")->refrences("id")->on("subcities")->default(0);
            $table->foreignId("qr_code_id")->refrences("id")->on("qr_codes")->default(0);
            $table->string("location_lat");
            $table->string("location_long");
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
