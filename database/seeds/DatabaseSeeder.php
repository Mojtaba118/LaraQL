<?php

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
        factory(\App\User::class,30)->create()->each(function ($user){
            factory(\App\Article::class,rand(5,20))->create([
                'user_id'=>$user->id
            ])->each(function ($article){
                factory(\App\Comment::class,rand(0,10))->create([
                    'article_id'=>$article->id,
                    'user_id'=>\App\User::all()->random()->id
                ]);
            });
        });
    }
}
