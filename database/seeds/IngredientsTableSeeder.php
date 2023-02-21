<?php

use Illuminate\Database\Seeder;
use App\IngredientsTranslation;
use App\Ingredients;

class IngredientsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Ingredients::class, 6)->create();

        for($i=1; $i<5; $i++){
             $ingredient = IngredientsTranslation::create([
                 'title' => 'Naslov sastojka na HR',
                 'ingredient_id' => $i,
                 'locale' => 'hr',
             ]);
             $ingredient->save();
        }
          for($i=1; $i<5; $i++){
                 $ingredient = IngredientsTranslation::create([
                  'title' => 'Naslov sastojka na EN',
                  'ingredient_id' => $i,
                  'locale' => 'en',
                 ]);
                 $ingredient->save();
             }

                 }
}
