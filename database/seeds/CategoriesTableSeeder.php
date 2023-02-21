<?php

use Illuminate\Database\Seeder;
use App\Categories;
use App\CategoriesTranslation;
class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    
       factory(Categories::class, 5)->create();

       for($i=1; $i<5; $i++){
            $category = CategoriesTranslation::create([
                'title' => 'Naslov kategorije na HR',
                'category_id' => $i,
                'locale' => 'hr',
            ]);
            $category->save();
       }
         for($i=1; $i<5; $i++){
                $category = CategoriesTranslation::create([
                 'title' => 'Naslov kategorije na EN',
                 'category_id' => $i,
                 'locale' => 'en',
                ]);
                $category->save();
            }
            
            

            
    }
}
