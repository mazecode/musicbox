<?php

use Illuminate\Database\Seeder;
use App\Role;
use App\User;
use App\Permission;

class RolePermissionSeeder extends Seeder
{
    public function run()
    {
        $owner = new Role();
        $owner->name         = 'owner';
        $owner->display_name = 'Project Owner';
        $owner->description  = 'User is the owner of a given project';
        $owner->save();

        $admin = new Role();
        $admin->name         = 'admin';
        $admin->display_name = 'User Administrator';
        $admin->description  = 'User is allowed to manage and edit other users';
        $admin->save();

        $owner = new Role();
        $owner->name         = 'user';
        $owner->display_name = 'Just aj Users';
        $owner->description  = 'Current role';
        $owner->save();

        //***** */

        $user = User::find(1);
        $user->roles()->attach($admin->id);

        //***** */

        $createUser = new Permission();
        $createUser->name         = 'create-user';
        $createUser->display_name = 'Create Users';
        $createUser->description  = 'create new user';
        $createUser->save();

        $editUser = new Permission();
        $editUser->name         = 'edit-user';
        $editUser->display_name = 'Edit Users';
        // Allow a user to...
        $editUser->description  = 'edit existing users';
        $editUser->save();

        $admin->perms()->sync([$createUser->id]);
        $owner->perms()->sync([$createUser->id, $editUser->id]);
    }
}
