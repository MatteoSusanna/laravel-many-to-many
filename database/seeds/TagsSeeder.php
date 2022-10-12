<?php

use Illuminate\Database\Seeder;
use App\Tag;
use Illuminate\Support\Str;

class TagsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tags = ['Vegetariana', 'Vegana', 'Crudista', 'Fruttariana'];

        foreach($tags as $tag){
                $newCategory = new Tag();
                $newCategory->name = $tag;
                $newCategory->slug = Str::slug($tag);
                $newCategory->save();
        }
    }
}
