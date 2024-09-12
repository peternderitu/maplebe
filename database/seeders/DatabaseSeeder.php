<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        
        $this->call(AdminSeeder::class);
        $this->call(CategorySeeder::class);
        $this->call(DealOwnerSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(DealSeeder::class);
        $this->call(MicroBlogSeeder::class);
        $this->call(ReportingReasonSeeder::class);
        $this->call(MicroBlogLikeSeeder::class);
        $this->call(MicroBlogCommentSeeder::class);
        $this->call(DealActivitySeeder::class);
        $this->call(ZAccessTokenSeeder::class);
    }
}
