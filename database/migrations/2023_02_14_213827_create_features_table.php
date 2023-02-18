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
        Schema::create('features', function (Blueprint $table) {
            $table->uuid("id");
            $table->primary("id");
            $table->enum("status",[0,1,2])->index();
            $table->enum("critial",[0,1,2,3,4])->index();
            $table->enum("activity",[0,1,2,3])->index();
            $table->integer("process")->default(0)->index();
            $table->date("deadline");
            $table->text("description");
            $table->boolean("from");
            $table->uuid("task_id");
            $table->foreign("task_id")->references("id")->on("tasks")->onDelete("cascade")->onUpdate("cascade");
            $table->uuid("base_feature_id");
            $table->foreign("base_feature_id")->references("id")->on("base_features")->onDelete("cascade")->onUpdate("cascade");
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
        Schema::dropIfExists('features');
    }
};