<?php

use Keep\Task;
use Illuminate\Database\Seeder;

class TagTaskTableSeeder extends Seeder {

    public function run()
    {
        for ($i = 1; $i <= 325; $i++)
        {
            $task = Task::find($i);

            for ($j = 1; $j <= 4; $j++)
            {
                $task->tags()->attach(rand(1, 8));
            }
        }
    }

}