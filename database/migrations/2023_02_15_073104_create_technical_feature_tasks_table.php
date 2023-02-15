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
        Schema::create('technical_feature_tasks', function (Blueprint $table) {
            $table->uuid("id");
            $table->primary("id");
            $table->uuid("technicalable_id");
            $table->string("technicalable_type");
            $table->uuid("technical_id");
            $table->foreign("technical_id")->references("id")->on("technicals")->onDelete("cascade")->onUpdate("cascade");
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
        Schema::dropIfExists('technical_feature_tasks');
    }
};
