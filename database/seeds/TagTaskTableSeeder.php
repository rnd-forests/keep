<?php

use Keep\Entities\Task;
use Illuminate\Database\Seeder;

class TagTaskTableSeeder extends Seeder
{
    public function run()
    {
        for ($i = 1; $i <= 410; $i++) {
            $task = Task::find($i);
            for ($j = 1; $j <= 8; $j++) {
                $task->tags()->attach(rand(1, 20));
            }
        }
    }
}