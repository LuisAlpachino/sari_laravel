<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reports', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('location');
            $table->longtext('content');
            $table->string('source');
            $table->unsignedInteger('fk_media_content')->nullable();
            $table->enum('status', ['ACTIVO', 'INACTIVO']); 
            $table->timestamps();
            $table->softDeletes($column = 'deleted_at', $precision = 0);
            $table->unsignedInteger('fk_notice_types');
            $table->unsignedInteger('fk_users');

            $table->foreign('fk_notice_types')->references('id')->on('notice_types');
            $table->foreign('fk_users')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reports');
    }
}
