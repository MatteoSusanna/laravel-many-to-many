<?php

use App\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = ['News', 'Cucina moderna', 'Cucina Molecolare', 'Cucina Tradizionale', 'Cucina Nazionale' ];

        foreach($categories as $category){
                $newCategory = new Category();
                $newCategory->name = $category;
                $newCategory->slug = Str::slug($category);
                $newCategory->save();
        }
    }
}
