<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMealsTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('meals_translations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();
            $table->string('locale')->index();

            $table->unsignedBigInteger('meal_id');	
            $table->unique(['meal_id','locale']);
            $table->foreign('meal_id')->references('id')->on('meals')->onDelete('cascade');

            $table->string('title');
            $table->longText('description');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('meals_translations');
    }
}
