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
        // $this->call(UsersTableSeeder::class);
        factory(User::class, 50)->create()->each(function ($user) {
            $user->posts()->saveMany(factory(Post::class, 10)->make());
        });

        $users = User::all();

        foreach ($users as $user) {
            $user->followers()->saveMany($users->random(rand(5, 40)));
        }
    }
}
