<?php

use Keep\Entities\User;
use Illuminate\Database\Seeder as Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Tables for seeding data.
     *
     * @var array
     */
    protected $tables = [
        'roles',
        'priorities',
        'permissions',
        'tags',
        'users',
        'groups',
    ];

    /**
     * Seeder classes.
     *
     * @var array
     */
    protected $seeders = [
        'RolesTableSeeder',
        'PrioritiesTableSeeder',
        'PermissionsTableSeeder',
        'TagsTableSeeder',
        'UsersTableSeeder',
        'GroupsTableSeeder',
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Eloquent::unguard();
        User::flushEventListeners();
        $this->truncateDatabase();
        foreach ($this->seeders as $seeder) {
            $this->call($seeder);
        }
    }

    /**
     * Truncate the database.
     */
    private function truncateDatabase()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        foreach ($this->tables as $table) {
            DB::table($table)->truncate();
        }
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}
