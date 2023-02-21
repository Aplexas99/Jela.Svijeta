<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTagsTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tags_translations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();
            $table->string('locale')->index();

            $table->unsignedBigInteger('tag_id');	
            $table->unique(['tag_id','locale']);
            $table->foreign('tag_id')->references('id')->on('tags')->onDelete('cascade');

            $table->string('title');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tags_translations');
    }
}
