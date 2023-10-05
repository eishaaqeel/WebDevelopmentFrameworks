<?php

namespace Database\Seeders;

use App\Models\Post;
use Illuminate\Database\Seeder;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Category;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        //generate fake data for everything except name:
        $user = User::factory()->create([
            'name' => 'Eisha Aqeel'
        ]);

        //generate 5 Posts
        Post::factory(5)->create([
            'user_id' => $user->id
        ]);

        //only need truncate if you don't refresh your database at the start
        // User::truncate();
        // Post::truncate();
        // Category::truncate();

        // $user = User::factory()->create();

        // $personal = Category::create([
        //     'name'=>'Personal',
        //     'slug'=>'personal'
        // ]);

        // $family = Category::create([
        //     'name'=>'Family',
        //     'slug'=>'family'
        // ]);

        // $work = Category::create([
        //     'name'=>'Work',
        //     'slug'=>'work'
        // ]);

        // Post::create([
        //     'user_id'=> $user->id,
        //     'category_id'=> $family->id,
        //     'title'=> 'My Family Post',
        //     'slug' => 'my-first-post',
        //     'excerpt' => '<p>Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>',
        //     'body' => '<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Minima eius ab ipsum distinctio beatae sunt quis odio facere neque voluptatum provident inventore explicabo cum recusandae veritatis rerum, est eos dignissimos!</p>'
        // ]);

        // Post::create([
        //     'user_id'=> $user->id,
        //     'category_id' => $work->id,
        //     'title'=> 'My Work Post',
        //     'slug' => 'my-work-post',
        //     'excerpt' => '<p>Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>',
        //     'body' => '<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Minima eius ab ipsum distinctio beatae sunt quis odio facere neque voluptatum provident inventore explicabo cum recusandae veritatis rerum, est eos dignissimos!</p>'
        // ]);

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
