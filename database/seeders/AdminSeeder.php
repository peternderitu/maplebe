<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('admins');
        $admins = [
            [
                'first_name' => 'Samuel',
                'last_name' => 'Njau',  
                'email' => 'snjauk@gmail.com',
                'password' => Hash::make('#Maplys@2024'),
            ],
            [
                'first_name' => 'Sarah',
                'last_name' => 'Kane',  
                'email' => 'sarakane17@gmail.com',
                'password' => Hash::make('#MaplysDev@2024'),
            ],
        ];
        DB::table('admins')-> insert($admins);
    }
}
