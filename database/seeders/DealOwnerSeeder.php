<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DealOwnerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('deal_owners');
        $deal_owners = [
            [
                'first_name' => 'Jane',
                'last_name' => 'Doe',  
                'email' => 'janedoe@gmail.com',
                'password' => Hash::make('12345678'),
            ]
        ];
        DB::table('deal_owners')-> insert($deal_owners);
    }
}
