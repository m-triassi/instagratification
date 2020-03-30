<?php

use App\Models\Post;
use App\Models\User;
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
        $maxUsers = env('SEED_MAX_USERS', 50);
        $postsPerUser = env('SEED_POSTS_PER_USER', 10);

        // $this->call(UsersTableSeeder::class);
        factory(User::class, $maxUsers)->create()->each(function ($user) use ($postsPerUser) {
            $user->posts()->saveMany(factory(Post::class, $postsPerUser)->make());
        });

        $users = User::all();

        foreach ($users as $user) {
            $user->followers()->saveMany($users->random(rand(1, $maxUsers)));
        }
    }
}
