<?php

use Illuminate\Database\Seeder as Seeder;

class DatabaseSeeder extends Seeder {

    /**
     * Tables for seeding data.
     *
     * @var array
     */
    protected $tables = [
        'users',
        'tasks',
        'tags',
        'tag_task',
    ];

    /**
     * Seeder classes.
     *
     * @var array
     */
    protected $seeders = [
        'UsersTableSeeder',
        'TasksTableSeeder',
        'TagsTableSeeder',
        'TagTaskTableSeeder',
    ];

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Eloquent::unguard();

		$this->truncateDatabase();

        foreach ($this->seeders as $seeder)
        {
            $this->call($seeder);
        }
	}

    /**
     * Truncate the database.
     */
    private function truncateDatabase()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');

        foreach ($this->tables as $table)
        {
            DB::table($table)->truncate();
        }

        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }

}
