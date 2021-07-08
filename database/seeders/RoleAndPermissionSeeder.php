<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;

class RoleAndPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Roles
        $admin = Role::create(['name' => "Administrator"]);
        $editor = Role::create(['name' => "Editor"]);
        $reporter = Role::create(['name' => "Reporter"]);

        Permission::create(['name' => 'report']);
        Permission::create(['name' => 'all']);

        $reporter->givePermissionTo('report');
        $admin->givePermissionTo('admin');
        $editor->givePermissionTo('editor');

        $user = User::find(1);
        $user->assignRole('Administrator');


    }
}
