<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->foreignId("project_id")->references("id")->on("projects")->cascadeOnDelete();
            $table->foreignId("milestone_id")->references("id")->on("milestones")->cascadeOnDelete();
            $table->integer("parent_id")->nullable();
            $table->string("title");
            $table->text("description");
            $table->string("status")->default("pending");
            $table->timestamps();
        });
    }

    /**p
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tasks');
    }
}
