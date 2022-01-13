<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAktivitetesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('aktivitetes', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('kuratori');
            $table->longText('description')->nullable();
            $table->date('production_date')->nullable();
            $table->integer('xvalue')->nullable();
            $table->integer('yvalue')->nullable();
            $table->string('location')->nullable();
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
        Schema::dropIfExists('aktivitetes');
    }
}
