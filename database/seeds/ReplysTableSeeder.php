<?php

use Illuminate\Database\Seeder;
use App\Models\Reply;

class ReplysTableSeeder extends Seeder
{
    public function run()
    {
        //所有用户的ID
        $user_ids = \App\Models\User::all()->pluck('id')->toArray();

        //所有话题ID
        $topic_ids = \App\Models\Topic::all()->pluck('id')->toArray();

        //获取Faker实例
        $faker = app(Faker\Generator::class);

        $replys = factory(Reply::class)
                        ->times(50)
                        ->make()
                        ->each(function ($reply, $index)
                            use ($faker, $topic_ids, $user_ids)
        {
            //从用户ID数组中随机取一个id
            $reply->user_id = $faker->randomElement($user_ids);

            //话题ID,同上
            $reply->topic_id = $faker->randomElement($topic_ids);
        });

        Reply::insert($replys->toArray());
    }

}

