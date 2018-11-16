<?php

use Illuminate\Database\Seeder;
use \Modules\Admin\Entities\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permission = [];

        Permission::all()->each(function($p) use (&$permission){
            $permission[$p->slug] = true;
        });

        $role = Sentinel::getRoleRepository()->createModel()->create([
            'name'          => 'Admin',
            'slug'          => 'admin',
            'permissions'   => $permission
        ]);

        $user = Sentinel::findByCredentials(['email'=>'admin@admin.com']);
        $role->users()->attach($user);

    }
}
