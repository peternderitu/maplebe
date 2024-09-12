<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users');
        $users = [
            [
                'first_name' => 'Jane',
                'last_name' => 'Doe',  
                'email' => 'janedoe@gmail.com',
                'password' => Hash::make('12345678'),
            ],
            [
                'first_name' => 'John',
                'last_name' => 'Doe',  
                'email' => 'johndoe@gmail.com',
                'password' => Hash::make('12345678'),
            ],
            [
                'first_name' => 'John',
                'last_name' => 'Smith',
                'email' => 'johnsmith@gmail.com',
                'password' => Hash::make('12345678'),
            ],
            [
                'first_name' => 'Emily',
                'last_name' => 'Johnson',
                'email' => 'emilyjohnson@gmail.com',
                'password' => Hash::make('12345678'),
            ],
            [
                'first_name' => 'Michael',
                'last_name' => 'Brown',
                'email' => 'michaelbrown@gmail.com',
                'password' => Hash::make('12345678'),
            ],
            [
                'first_name' => 'Sarah',
                'last_name' => 'Davis',
                'email' => 'sarahdavis@gmail.com',
                'password' => Hash::make('12345678'),
            ],
            [
                'first_name' => 'David',
                'last_name' => 'Miller',
                'email' => 'davidmiller@gmail.com',
                'password' => Hash::make('12345678'),
            ],
            [
                'first_name' => 'Laura',
                'last_name' => 'Wilson',
                'email' => 'laurawilson@gmail.com',
                'password' => Hash::make('12345678'),
            ],
            [
                'first_name' => 'James',
                'last_name' => 'Moore',
                'email' => 'jamesmoore@gmail.com',
                'password' => Hash::make('12345678'),
            ],
            [
                'first_name' => 'Olivia',
                'last_name' => 'Taylor',
                'email' => 'oliviataylor@gmail.com',
                'password' => Hash::make('12345678'),
            ],
            [
                'first_name' => 'Robert',
                'last_name' => 'Anderson',
                'email' => 'robertanderson@gmail.com',
                'password' => Hash::make('12345678'),
            ],
            [
                'first_name' => 'Jessica',
                'last_name' => 'Thomas',
                'email' => 'jessicathomas@gmail.com',
                'password' => Hash::make('12345678'),
            ],
            [
                'first_name' => 'Charles',
                'last_name' => 'Jackson',
                'email' => 'charlesjackson@gmail.com',
                'password' => Hash::make('12345678'),
            ],
            [
                'first_name' => 'Amanda',
                'last_name' => 'White',
                'email' => 'amandawhite@gmail.com',
                'password' => Hash::make('12345678'),
            ],
            [
                'first_name' => 'Daniel',
                'last_name' => 'Harris',
                'email' => 'danielharris@gmail.com',
                'password' => Hash::make('12345678'),
            ],
            [
                'first_name' => 'Rachel',
                'last_name' => 'Martin',
                'email' => 'rachelmartin@gmail.com',
                'password' => Hash::make('12345678'),
            ],
            [
                'first_name' => 'Thomas',
                'last_name' => 'Garcia',
                'email' => 'thomasgarcia@gmail.com',
                'password' => Hash::make('12345678'),
            ],
            [
                'first_name' => 'Patricia',
                'last_name' => 'Martinez',
                'email' => 'patriciamartinez@gmail.com',
                'password' => Hash::make('12345678'),
            ],
            [
                'first_name' => 'Matthew',
                'last_name' => 'Robinson',
                'email' => 'matthewrobinson@gmail.com',
                'password' => Hash::make('12345678'),
            ],
            [
                'first_name' => 'Sophia',
                'last_name' => 'Clark',
                'email' => 'sophiaclark@gmail.com',
                'password' => Hash::make('12345678'),
            ],
            [
                'first_name' => 'Christopher',
                'last_name' => 'Rodriguez',
                'email' => 'christopherrodriguez@gmail.com',
                'password' => Hash::make('12345678'),
            ],
            [
                'first_name' => 'Emma',
                'last_name' => 'Lewis',
                'email' => 'emmalewis@gmail.com',
                'password' => Hash::make('12345678'),
            ],
        ];
        DB::table('users')-> insert($users);
    }
}
