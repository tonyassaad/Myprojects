<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Schema;

class CreatePagesTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('pages', function (Blueprint $table) {
            $table->increments('id');
            $table->string('link');
            $table->string('location_name');
            $table->string('category');
            $table->longText('area');
            $table->string('frequency');
            $table->dateTime('next_visit_time')->default(\Carbon\Carbon::now());
            $table->dateTime('last_visit_time')->default(\Carbon\Carbon::now());
            //associate is w'ith domain
            $table->integer('domain_id')->unsigned();
            $table->foreign('domain_id')->references('id')->on('domains');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('pages');
    }

}
