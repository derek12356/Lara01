<?php

use Illuminate\Database\Seeder;

class FollowersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::all();
        $user = $user->first();
        $user_id = $user->id;

        $followers = $users->slice(1);
        $follower_ids = $followrs->pluck('id')->toArray();

        $user->follow($follower_ids);

        foreach($followers as $follower){
        	$follower->follow($user_id);
        }

    }
}
