<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories');
        $categories = [
            [
                'category_name' => 'Foods and Drinks', 
                'image_url' => 'Foods&Drinks.png'
            ],
            [
                'category_name' => 'Technology', 
                'image_url' => 'Technology.png'
            ],
            [
                'category_name' => 'Wellbeing', 
                'image_url' => 'Wellbeing.png'
            ],
            [
                'category_name' => 'Fashion', 
                'image_url' => 'Fashion.png'
            ],
            [
                'category_name' => 'Beauty', 
                'image_url' => 'Beauty.png'
            ],
            [
                'category_name' => 'Travel', 
                'image_url' => 'Travel.png'
            ],
        ];
        DB::table('categories')-> insert($categories);
    }
}
