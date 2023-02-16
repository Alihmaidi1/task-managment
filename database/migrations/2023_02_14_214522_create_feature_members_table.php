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
        Schema::create('feature_members', function (Blueprint $table) {
            $table->id();
            $table->uuid("member_id");
            $table->foreign("member_id")->references("id")->on("users")->onDelete("cascade")->onUpdate("cascade");
            $table->uuid("feature_id");
            $table->foreign("feature_id")->references("id")->on("features")->onDelete("cascade")->onUpdate("cascade");
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
        Schema::dropIfExists('feature_members');
    }
};
