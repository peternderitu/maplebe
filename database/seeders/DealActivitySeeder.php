<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class DealActivitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('deal_activities');
        $deal_activities = [
            [
                'user_id' => 1,
                'deal_id' => 1,
                'created_at' => '2024-07-08 00:00:00'
            ],
            [
                'user_id' => 2,
                'deal_id' => 1,
                'created_at' => '2024-08-08 00:00:00'
            ],
            [
                'user_id' => 3,
                'deal_id' => 1,
                'created_at' => '2024-09-08 00:00:00'
            ],
            [
                'user_id' => 4,
                'deal_id' => 1,
                'created_at' => '2024-10-08 00:00:00'
            ],
            [
                'user_id' => 5,
                'deal_id' => 1,
                'created_at' => '2024-11-08 00:00:00'
            ],
            [
                'user_id' => 6,
                'deal_id' => 1,
                'created_at' => '2024-12-08 00:00:00'
            ],
            [
                'user_id' => 7,
                'deal_id' => 1,
                'created_at' => '2024-01-08 00:00:00'
            ],
            [
                'user_id' => 8,
                'deal_id' => 1,
                'created_at' => '2024-02-08 00:00:00'
            ],
            [
                'user_id' => 9,
                'deal_id' => 1,
                'created_at' => '2024-03-08 00:00:00'
            ],
            [
                'user_id' => 10,
                'deal_id' => 1,
                'created_at' => '2024-04-08 00:00:00'
            ],
            [
                'user_id' => 11,
                'deal_id' => 1,
                'created_at' => '2024-05-08 00:00:00'
            ],
            [
                'user_id' => 12,
                'deal_id' => 1,
                'created_at' => '2024-06-08 00:00:00'
            ],
            [
                'user_id' => 13,
                'deal_id' => 1,
                'created_at' => '2024-07-08 00:00:00'
            ],
            [
                'user_id' => 14,
                'deal_id' => 1,
                'created_at' => '2024-08-08 00:00:00'
            ],
            [
                'user_id' => 15,
                'deal_id' => 1,
                'created_at' => '2024-09-08 00:00:00'
            ],
            [
                'user_id' => 16,
                'deal_id' => 1,
                'created_at' => '2024-10-08 00:00:00'
            ],
            [
                'user_id' => 17,
                'deal_id' => 1,
                'created_at' => '2024-11-08 00:00:00'
            ],
            [
                'user_id' => 18,
                'deal_id' => 1,
                'created_at' => '2024-12-08 00:00:00'
            ],
            [
                'user_id' => 19,
                'deal_id' => 1,
                'created_at' => '2024-12-08 00:00:00'
            ],
            [
                'user_id' => 20,
                'deal_id' => 1,
                'created_at' => '2024-12-08 00:00:00'
            ],
            [
                'user_id' => 21,
                'deal_id' => 1,
                'created_at' => '2024-11-08 00:00:00'
            ],
        ];
        DB::table('deal_activities')-> insert($deal_activities);
    }
}
