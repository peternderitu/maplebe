<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class ZAccessTokenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('z_access_tokens');
        $z_access_tokens = [
            [
                'access_token' => '1000.1c34f83b2e231f6f16d3e06189b2f865.652da0719ad8d6cbe1ec85a6395624b4',
                'refresh_token' => '1000.862fac504f66d6463472aa85cd0bc776.8ad1c6048c79addde7ec39e0abba6737'
            ]
        ];
        DB::table('z_access_tokens')-> insert($z_access_tokens);
    }
}
