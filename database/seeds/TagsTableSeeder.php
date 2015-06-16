<?php

use Illuminate\Database\Seeder;

class TagsTableSeeder extends Seeder
{
    public function run()
    {
        factory(Keep\Entities\Tag::class, 15)->create();
    }
}