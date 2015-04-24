<?php

use Illuminate\Database\Seeder;

class AssignablesTableSeeder extends Seeder {

    public function run()
    {
        for ($i = 1; $i <= 500; $i++)
        {
            DB::table('assignables')->insert([
                'assignment_id'   => rand(1, 50),
                'assignable_id'   => rand(1, 152),
                'assignable_type' => 'Keep\User'
            ]);
        }

        for ($i = 1; $i <= 400; $i++)
        {
            DB::table('assignables')->insert([
                'assignment_id'   => rand(1, 50),
                'assignable_id'   => rand(1, 50),
                'assignable_type' => 'Keep\Group'
            ]);
        }
    }

}