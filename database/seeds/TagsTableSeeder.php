<?php

use Keep\Tag;
use Illuminate\Database\Seeder;

class TagsTableSeeder extends Seeder {

    public function run()
    {
        $tags = ['personal', 'work', 'coding', 'book', 'film', 'reading', 'drawing', 'climbing'];

        foreach ($tags as $tag)
        {
            Tag::create(['name' => $tag]);
        }
    }

}