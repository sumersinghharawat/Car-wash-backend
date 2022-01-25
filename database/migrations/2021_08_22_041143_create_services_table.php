<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    // id
    // name
    // short_description
    // long_description
    // service_image
    // service_category
    // service _variant
    // service_rating
    // service_employee
    // Service_status

    public function up()
    {
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->string("name");
            $table->text("short_description")->nullable();
            $table->text("long_description")->nullable();
            $table->string("service_image");
            $table->string("category");
            $table->text("employee")->nullable();
            $table->string("discountprice")->nullable();
            $table->string("price")->nullable();
            $table->time("time")->default("00:00:00");
            $table->integer("status")->default(0);
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
        Schema::dropIfExists('services');
    }
}
