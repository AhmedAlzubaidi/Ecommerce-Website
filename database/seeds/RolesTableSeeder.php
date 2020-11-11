<?php

use App\Role;
use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Role::class)->create(['name' => 'Admin']);
        factory(Role::class)->create(['name' => 'Moderator']);
        factory(Role::class)->create(['name' => 'Stock Manager']);
        factory(Role::class)->create(['name' => 'Customer']);
    }
}
