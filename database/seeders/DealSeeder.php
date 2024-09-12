<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class DealSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    public function run()
    {
        DB::table('deals');
        $deals = [
            [
                'category_id' => 4,
                'deal_owner_id' => 1,
                'title' => '30% off on Zara Cardigan',
                'description' => 'Stay cozy in style! Enjoy unbeatable comfort and fashion with our exclusive cardigan offer from Zara. Elevate your wardrobe with timeless elegance at an irresistible price.',
                'start_date' => '2024-06-21 00:00:00',
                'end_date' => '2024-09-21 00:00:00',
                'original_price' => '1000',
                'discount' => '30',
                'discounted_price' => '700',
                'image_url' => 'sweater.jpg',
                'logo_url' => 'Zara_Logo.png',
                'brand_name' => 'Zara',
                'discount_url' => 'https://www.zara.com/ww/',
                'status' => 1,
                'unique_deal_identifier' => (string) Str::uuid(),
            ],
            [
                'category_id' => 4,
                'deal_owner_id' => 1,
                'title' => 'Nike Sneakers at 20% off',
                'description' => 'Upgrade your sneaker game and enjoy 20% off our stylish selection, perfect for every step of your journey!',
                'start_date' => '2024-06-21 00:00:00',
                'end_date' => '2024-09-21 00:00:00',
                'original_price' => '1500',
                'discount' => '30',
                'discounted_price' => '1050',
                'image_url' => 'sneakers.png',
                'logo_url' => 'Nike_Logo.png',
                'brand_name' => 'Nike',
                'discount_url' => 'https://www.nike.com/ca/',
                'status' => 1,
                'unique_deal_identifier' => (string) Str::uuid(),
            ],
            [
                'category_id' => 2,
                'deal_owner_id' => 1,
                'title' => 'Laptop at 20% off',
                'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi a laoreet velit. Nullam maximus odio ac cursus imperdiet. Donec ultricies libero eros, ut aliquam nulla sagittis eget. Nullam facilisis fringilla purus imperdiet interdum. Morbi porttitor rhoncus sapien, nec rutrum erat sagittis nec. Nullam eget felis sem',
                'start_date' => '2024-06-21 00:00:00',
                'end_date' => '2024-09-21 00:00:00',
                'original_price' => '1500',
                'discount' => '30',
                'discounted_price' => '1050',
                'image_url' => 'deal3.jpg',
                'logo_url' => 'dellLogo.png',
                'brand_name' => 'Dell',
                'discount_url' => 'https://www.dell.com/en-ca',
                'status' => 1,
                'unique_deal_identifier' => (string) Str::uuid(),
            ],
            [
                'category_id' => 5,
                'deal_owner_id' => 1,
                'title' => '20% off on Fenty Hair products',
                'description' => 'Universal must-haves that repair and provide the moisture your hair needs. Looking for more intense moisture? Check out our Deep Moisture Repair The Maintenance Crew Full-Size Bundle',
                'start_date' => '2024-06-21 00:00:00',
                'end_date' => '2024-09-21 00:00:00',
                'original_price' => '1500',
                'discount' => '30',
                'discounted_price' => '1050',
                'image_url' => 'deal4.png',
                'logo_url' => 'fenty_logo.png',
                'brand_name' => 'Fenty Beauty',
                'discount_url' => 'https://fentybeauty.com/en-ca/products/moisture-repair-the-maintenance-crew-full-size-bundle?variant=42657503969325',
                'status' => 1,
                'unique_deal_identifier' => (string) Str::uuid(),
            ],
            [
                'category_id' => 4,
                'deal_owner_id' => 1,
                'title' => '29% off on Gunnared black OSKARSHAMN Wing chair',
                'description' => 'You can complete your wing chair with OSKARSHAMN footstool to sit even more comfortably. This classic and timeless wing chair with an embracing backrest gives you relaxing me-time and is also great to sit on while enjoying socializing with others.',
                'start_date' => '2024-06-21 00:00:00',
                'end_date' => '2024-09-21 00:00:00',
                'original_price' => '1500',
                'discount' => '30',
                'discounted_price' => '1050',
                'image_url' => 'deal5.png',
                'logo_url' => 'IKEA_logo.svg',
                'brand_name' => 'IKEA',
                'discount_url' => 'https://www.ikea.com.do/en/offerItems/rooms/living-room/?&&is_offer=1&order=OFFERDISC&complete=1&hfb[]=1001',
                'status' => 1,
                'unique_deal_identifier' => (string) Str::uuid(),
            ],

        ];
        DB::table('deals')-> insert($deals);
    }
}
