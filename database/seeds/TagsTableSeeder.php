<?php

use Keep\Entities\Tag;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class TagsTableSeeder extends Seeder {

    public function run()
    {
        $faker = Faker::create();

        for ($i = 0; $i <= 20; $i++)
        {
            Tag::create(['name' => implode(' ', $faker->words(rand(2, 4)))]);
        }
    }

}