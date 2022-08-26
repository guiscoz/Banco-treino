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
        Schema::create('locations', function (Blueprint $table) {
            $table->id();
            $table->string("query");
            $table->string("status");
            $table->string("country");
            $table->string("regionName");
            $table->string("city");
            $table->string("lat");
            $table->string("lon");
            $table->string("timezone");
            $table->string('zip')->nullable();
            $table
                ->foreignId('user_id')
                ->unsigned()
                ->references('id')
                ->on('users');
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
        Schema::dropIfExists('locations');
    }
};
