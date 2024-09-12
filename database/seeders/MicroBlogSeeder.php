<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MicroBlogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('micro_blogs');
        $micro_blogs = [
            [
                'user_id' => 1,
                'title' => '50% off on MacDonalds burgers',
                'description' => 'Deal is available only for this weekend',
                'start_date' => '2024-06-21 00:00:00',
                'end_date' => '2024-09-21 00:00:00',
                'image_url' => 'micro_blog_deal1.jpg',
                'discount_url' => 'https://kfc.ke',
                'original_price' => '10',
                'discounted_price' => '5',
                'category_id' => 1,
            ],
            [
                'user_id' => 1,
                'title' => 'Get any Starbucks coffee at $2',
                'description' => 'Deal is available only for this weekend',
                'start_date' => '2024-06-21 00:00:00',
                'end_date' => '2024-09-21 00:00:00',
                'image_url' => 'micro_blog_deal2.png',
                'discount_url' => 'https://www.starbucks.com',
                'original_price' => '10',
                'discounted_price' => '2',
                'category_id' => 1,
            ],
            [
                'user_id' => 1,
                'title' => '10% off Davids Tea',
                'description' => 'Check out DAVIDsTEA today and you can choose from over 100 teas, including exclusive blends, limited edition seasonal collections, traditional teas, pure and flavoured matchas and exotic infusions from around the globe. Not to mention the largest collection of organic teas and infusions in North America.',
                'start_date' => '2024-06-21 00:00:00',
                'end_date' => '2024-09-21 00:00:00',
                'image_url' => 'micro_blog_deal3.jpg',
                'discount_url' => 'https://www.davidstea.com/ca_en/home/',
                'original_price' => '10',
                'discounted_price' => '2',
                'category_id' => 1,
            ],
            [
                'user_id' => 1,
                'title' => '15% off on Royal Ontario Museum Admission',
                'description' => 'Connect with art, culture, and nature at the Royal Ontario Museum - Canada’s largest museum takes you on an epic journey from 4.5 billion years ago to today.',
                'start_date' => '2024-06-21 00:00:00',
                'end_date' => '2024-09-21 00:00:00',
                'image_url' => 'micro_blog_deal4.jpg',
                'discount_url' => 'https://www.rom.on.ca/en',
                'original_price' => '10',
                'discounted_price' => '5',
                'category_id' => 6,
            ],
            [
                'user_id' => 1,
                'title' => 'Save up to 8% on your first booking',
                'description' => 'Deal is available only for this weekend',
                'start_date' => '2024-06-21 00:00:00',
                'end_date' => '2024-09-21 00:00:00',
                'image_url' => 'micro_blog_deal5.jpg',
                'discount_url' => 'https://www.trips.com',
                'original_price' => '10',
                'discounted_price' => '5',
                'category_id' => 6,
            ],
            [
                'user_id' => 1,
                'title' => '10% off on macbook',
                'description' => 'Deal is available only for this weekend',
                'start_date' => '2024-06-21 00:00:00',
                'end_date' => '2024-09-21 00:00:00',
                'image_url' => 'micro_blog_deal6.png',
                'discount_url' => 'https://www.apple.com/ca/',
                'original_price' => '10',
                'discounted_price' => '2',
                'category_id' => 1,
            ],
        ];
        DB::table('micro_blogs')-> insert($micro_blogs);
    }
}
