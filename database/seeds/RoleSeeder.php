<?php


use Illuminate\Database\Seeder;
use App\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = array(
        array('name' => 'Administrator', 'slug' => 'administrator'),
        array('name' => 'Supervisor', 'slug' => 'supervisor'),
        array('name' => 'manager', 'slug' => 'manager'),
      );

        foreach ($roles as $role) {
            Role::create($role);
        }
    }
}
