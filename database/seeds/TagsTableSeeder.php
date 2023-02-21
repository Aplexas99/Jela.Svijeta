<?php

use Illuminate\Database\Seeder;
use App\Tags;
use App\TagsTranslation;

class TagsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
       factory(Tags::class, 10)->create();

        for($i=1; $i<5; $i++){
             $tag = TagsTranslation::create([
                 'title' => 'Naslov taga na HR',
                 'tag_id' => $i,
                 'locale' => 'hr',
             ]);
             $tag->save();
        }
          for($i=1; $i<5; $i++){
                 $tag = TagsTranslation::create([
                  'title' => 'Naslov taga na EN',
                  'tag_id' => $i,
                  'locale' => 'en',
                 ]);
                 $tag->save();
             }

         
        
             
    }
}
