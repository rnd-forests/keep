<?php

use Keep\Entities\Priority;
use Illuminate\Database\Seeder;

class PrioritiesTableSeeder extends Seeder
{
    public function run()
    {
        $priorities = [
            [
                'name'        => 'urgent',
                'value'       => 3,
                'description' => 'Urgent priority level'
            ],
            [
                'name'        => 'high',
                'value'       => 2,
                'description' => 'High priority level'
            ],
            [
                'name'        => 'normal',
                'value'       => 1,
                'description' => 'Normal priority level'
            ],
            [
                'name'        => 'low',
                'value'       => 0,
                'description' => 'Low priority level'
            ]
        ];

        foreach ($priorities as $priority) {
            Priority::create($priority);
        }
    }
}