<?php

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Seeder;

class TravisSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new User();
        $user->name = 'travis';
        $user->email = 'travis@example.com';
        $user->password = bcrypt('VerySecurePassword');
        $user->save();

        for ($i = 0; $i <= 5; $i++) {
            $p = new Post();
            $p->media = 'some/media/at/a/path';
            $p->caption = 'Some neat caption';
            $p->author()->associate($user);
            $p->save();
        }
    }
}
