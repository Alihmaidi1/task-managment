<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->uuid("id");
            $table->primary("id");
            $table->string("name");
            $table->enum("status",[0,1]);
            $table->enum("critial",[0,1,2,3,4]);
            $table->integer("process")->default(0);
            $table->date("deadline");
            $table->text("description");
            $table->boolean("from");
            $table->uuid("team_id");
            $table->foreign("team_id")->references("id")->on("teams")->onDelete("cascade")->onUpdate("cascade");
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
        Schema::dropIfExists('tasks');
    }
};
