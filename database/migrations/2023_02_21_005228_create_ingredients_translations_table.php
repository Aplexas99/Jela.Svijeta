<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIngredientsTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ingredients_translations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();
            $table->string('locale')->index();

            $table->unsignedBigInteger('ingredient_id');	
            $table->unique(['ingredient_id','locale']);
            $table->foreign('ingredient_id')->references('id')->on('ingredients')->onDelete('cascade');

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
        Schema::dropIfExists('ingredients_translations');
    }
}
