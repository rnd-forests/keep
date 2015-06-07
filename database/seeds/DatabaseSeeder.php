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
        'users',
        'profiles',
        'tasks',
        'roles',
        'role_user',
        'permissions',
        'assignments',
        'assignables',
        'tags',
        'tag_task',
        'groups',
        'group_user',
        'priorities',
        'notifications'
    ];

    /**
     * Seeder classes.
     *
     * @var array
     */
    protected $seeders = [
        'UsersTableSeeder',
        'ProfilesTableSeeder',
        'TasksTableSeeder',
        'RolesTableSeeder',
        'RoleUserTableSeeder',
        'PermissionsTableSeeder',
        'AssignmentsTableSeeder',
        'AssignablesTableSeeder',
        'TagsTableSeeder',
        'TagTaskTableSeeder',
        'GroupsTableSeeder',
        'GroupUserTableSeeder',
        'PrioritiesTableSeeder',
        'NotificationsTableSeeder'
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
        // $this->truncateDatabase();
        foreach ($this->seeders as $seeder) {
            $this->call($seeder);
        }
    }

    /**
     * Truncate the database.
     */
    private function truncateDatabase()
    {
        // DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        DB::statement('SET CONSTRAINTS ALL DEFERRED');
        foreach ($this->tables as $table) {
            DB::table($table)->truncate();
        }
        // DB::statement('SET FOREIGN_KEY_CHECKS = 1');
        DB::statement('SET CONSTRAINTS ALL IMMEDIATE');
    }
}
