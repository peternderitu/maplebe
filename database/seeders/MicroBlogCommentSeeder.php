<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MicroBlogCommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('parent_comments');
        $parent_comments = [
            // user_id, micro_blog_id, content
            [
              'user_id' => 19,
              'micro_blog_id' => 1,
              'content' => 'I feel so lucky I saw this deal before it expired. I had a really good meal 50% off'  
            ],
            [
              'user_id' => 8,
              'micro_blog_id' => 1,
              'content' => "Great deal, couldn't recommend it enough" 
            ],
            [
              'user_id' => 3,
              'micro_blog_id' => 1,
              'content' => "I honestly thought this was a fad but checked it out and it was legit" 
            ],
            [
                'user_id' => 4,
                'micro_blog_id' => 1,
                'content' => "Wow! 50% off at McDonald's? I'm lovin' it!" 
            ],
            [
                'user_id' => 20,
                'micro_blog_id' => 1,
                'content' => "Can't believe this deal! Time to grab some Big Macs." 
            ],
            [
              'user_id' => 5,
              'micro_blog_id' => 2,
              'content' => "Starbucks coffee for $2? That's a dream come true!" 
            ],
            [
              'user_id' => 7,
              'micro_blog_id' => 2,
              'content' => "I don't know how they find them but Whiz deals has some legit deals. Glad I ot this coffee deal" 
            ],
            [
              'user_id' => 1,
              'micro_blog_id' => 3,
              'content' => "Just what I needed! Starbucks for $2? Count me in!"
            ],
            [
              'user_id' => 9,
              'micro_blog_id' => 3,
              'content' => "I'm loving this $2 coffee deal! Thanks, Starbucks!"
            ],
            [
              'user_id' => 11,
              'micro_blog_id' => 2,
              'content' => "Can't wait to get my favorite latte for just $2!" 
            ],
            [
              'user_id' => 13,
              'micro_blog_id' => 4,
              'content' => "Just in time for lunch. McDonald's, here I come!"
            ],
            [
              'user_id' => 14,
              'micro_blog_id' => 5,
              'content' => "Half price on everything? I need to make multiple trips."
            ],
            
            [
              'user_id' => 15,
              'micro_blog_id' => 2,
              'content' => "This is amazing! $2 for any coffee at Starbucks? I'm there!" 
            ],
            [
              'user_id' => 5,
              'micro_blog_id' => 3,
              'content' =>  "Can't believe my luck! Starbucks coffee for just $2!" 
            ],
            [
              'user_id' => 6,
              'micro_blog_id' => 4,
              'content' => "Half off my favorite burgers? Count me in!"
            ],
            [
              'user_id' => 16,
              'micro_blog_id' => 5,
              'content' =>  "This makes my day. Cheap and tasty McDonald's meals!"
            ],
            [
              'user_id' => 17,
              'micro_blog_id' => 5,
              'content' => "Perfect timing for this deal. Can't wait to dig in!" 
            ],
            [
              'user_id' => 6,
              'micro_blog_id' => 4,
              'content' => "Perfect excuse for a McFlurry today. So excited!" 
            ],
            [
              'user_id' => 7,
              'micro_blog_id' => 3,
              'content' =>  "This is perfect! Time to enjoy my favorite macchiato for $2." 
            ],
            [
              'user_id' => 18,
              'micro_blog_id' => 2,
              'content' => "Time to try all the new flavors. Thanks, Starbucks!"  
            ],
            
            [
              'user_id' => 12,
              'micro_blog_id' => 2,
              'content' => "Starbucks for $2? I'm definitely grabbing my daily fix!"
            ],
            [
              'user_id' => 2,
              'micro_blog_id' => 3,
              'content' =>  "Best news ever! $2 coffee at Starbucks? I'm sold!"  
            ],
            [
              'user_id' => 21,
              'micro_blog_id' => 4,
              'content' => "Whiz deals never disappoint. 50% off is amazing!" 
            ],
            [
              'user_id' => 13,
              'micro_blog_id' => 5,
              'content' => "I love McDonald's, and this discount is just awesome!"
            ],
            [
              'user_id' => 8,
              'micro_blog_id' => 6,
              'content' =>"Can't wait to grab my favorite brew for just $2. Thank you, Starbucks!" 
            ],
            [
              'user_id' => 10,
              'micro_blog_id' => 3,
              'content' =>  "Incredible deal! Heading to Starbucks for some $2 goodness." 
            ],
            [
              'user_id' => 13,
              'micro_blog_id' => 5,
              'content' =>  "50% off? That's too good to pass up. See you soon, McDonald's!" 
            ],
            [
              'user_id' => 14,
              'micro_blog_id' => 2,
              'content' => "What a deal! Perfect excuse to grab a Frappuccino today." 
            ],
            [
              'user_id' => 2,
              'micro_blog_id' => 4,
              'content' => "I'm taking the whole family out for this one. Thanks, McDonald's!" 
            ],
            [
              'user_id' => 1,
              'micro_blog_id' => 2,
              'content' => "Coffee for $2? Looks like I'll be making multiple trips to Starbucks."
            ],
            [
              'user_id' => 21,
              'micro_blog_id' => 4,
              'content' => "Time to enjoy some fries and nuggets at a steal!"
            ],
            [
              'user_id' => 11,
              'micro_blog_id' => 6,
              'content' => "Can't wait to grab my favorite brew for just $2. Thank you, Starbucks!"  
            ],
            [
              'user_id' => 3,
              'micro_blog_id' => 6,
              'content' => "Unreal deal! Coffee at Starbucks for $2? I'm getting all my favorites!" 
            ],
            [
              'user_id' => 10,
              'micro_blog_id' => 3,
              'content' =>  "Amazing! $2 for any coffee at Starbucks? I'm so excited!" 
            ],
            [
              'user_id' => 19,
              'micro_blog_id' => 5,
              'content' => "What a great deal! Heading to McDonald's right now."
            ],
            [
              'user_id' => 17,
              'micro_blog_id' => 1,
              'content' =>  "This is the best news I've heard all week. Thanks, McDonald's!"
            ],
            [
              'user_id' => 16,
              'micro_blog_id' => 2,
              'content' => "Unbelievable deal! My mornings just got better with $2 coffee."  
            ],
            [
              'user_id' => 15,
              'micro_blog_id' => 3,
              'content' => "Starbucks just made my day with this $2 coffee deal!" 
            ],
            [
              'user_id' => 5,
              'micro_blog_id' => 4,
              'content' =>  "This is the best news I've heard all week. Thanks, McDonald's!" 
            ],
        ];
        DB::table('parent_comments')->insert($parent_comments);
    }
}
