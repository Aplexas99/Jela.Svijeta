<?php

use Illuminate\Database\Seeder;
use App\Meals;
use App\MealsTranslation;


class MealsTableSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        for($i=1; $i<5; $i++){
            $meal = Meals::create([
                'category_id' => $i,
            ]);
            $meal->save();
       }
       
        $meal = Meals::create([
            'category_id' => NULL,
        ]);
            $meal->save();


        for($i=1; $i<5; $i++){
            $meal = MealsTranslation::create([
                'title' => 'Naslov jela na HR',
                'description' => 'Opis jela na HR',
                'meal_id' => $i,
                'locale' => 'hr',
            ]);
            $meal->save();
       }
         for($i=1; $i<5; $i++){
                $meal = MealsTranslation::create([
                 'title' => 'Naslov jela na EN',
                 'description' => 'Opis jela na EN'.$i,
                 'meal_id' => $i,
                 'locale' => 'en',
                ]);
                $meal->save();
            }

             // pivot table
      
             DB::table('meal_tag')->insert([
                'meal_id' => 1,
                'tag_id' => 2,
            ]);
            DB::table('meal_tag')->insert([
                'meal_id' => 2,
                'tag_id' => 1,
            ]);

            
    // pivot table
        foreach(range(1, 5) as $index)
        {
            DB::table('ingredient_meal')->insert([
                'meal_id' => 0+$index,
                'ingredient_id' => 0+$index,
            ]);
            DB::table('ingredient_meal')->insert([
                'meal_id' => 0+$index,
                'ingredient_id' => 1+$index,
            ]);
        }
    
    }

}
