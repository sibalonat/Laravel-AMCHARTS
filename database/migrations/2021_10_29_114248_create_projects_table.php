<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->string('name');
            $table->string('authorname');
            $table->string('mediumi');
            // $table->longText('description');
            $table->longText('shortdescription')->nullable();
            $table->date('production_date')->nullable();
            $table->integer('xvalue')->nullable();
            $table->integer('yvalue')->nullable();
            $table->string('location')->nullable();
            $table->double('lat')->nullable();
            $table->double('lon')->nullable();
            $table->string('fixed')->nullable();
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
        Schema::dropIfExists('projects');
    }
}
