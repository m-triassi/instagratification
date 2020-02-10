<?php

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Post;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $maxUsers = env("SEED_MAX_USERS", 50);
        $postsPerUser = env("SEED_POSTS_PER_USER", 10);

        // $this->call(UsersTableSeeder::class);
        factory(App\Models\User::class, $maxUsers)->create()->each(function ($user) use ($postsPerUser) {
            $user->posts()->saveMany(factory(App\Models\Post::class, $postsPerUser)->make());
        });

        $users = User::all();

        foreach ($users as $user) {
            $user->followers()->saveMany($users->random(rand(1, $maxUsers)));
        }
    }
}
