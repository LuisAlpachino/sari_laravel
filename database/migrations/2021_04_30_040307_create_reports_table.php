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
            $table->string('title');
            $table->text('summary');
            $table->longtext('content');
            // $table->string('type');
            // $table->string('source');
            // $table->unsignedInteger('fk_media_content')->nullable();
            // $table->enum('status', ['ACTIVO', 'INACTIVO']); 
            $table->unsignedBigInteger('fk_news_types');
            $table->unsignedBigInteger('fk_municipalities');
            $table->unsignedBigInteger('fk_status');
            $table->unsignedBigInteger('fk_users');
            $table->timestamps();
            $table->softDeletes($column = 'deleted_at', $precision = 0);

            $table->foreign('fk_news_types')->references('id')->on('news_types');
            $table->foreign('fk_municipalities')->references('id')->on('municipalities');
            $table->foreign('fk_status')->references('id')->on('status');
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
