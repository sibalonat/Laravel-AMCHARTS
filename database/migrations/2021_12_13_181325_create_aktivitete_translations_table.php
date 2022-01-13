<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAktiviteteTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('aktivitete_translations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('aktivitete_id')->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->string('locale');
            // $table->text('description');
            $table->longText('description');
            $table->unique(['aktivitete_id', 'locale']);
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
        Schema::dropIfExists('aktivitete_translations');
    }
}
