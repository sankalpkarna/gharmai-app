<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

    
       //Admin Seeder
        $user = User::create([
            'name' => 'Sankalp Karna', 
            'email' => 'karn.sankalp@gmail.com',
            'password' => bcrypt('salman'),
            'mobile_number' => '9802100617',
            'is_email_verified' =>'1'
        ]);

        // create roles and assign created permissions


        $role  = Role::create(['name' => 'admin']);
        $role1 = Role::create(['name' => 'provider']);
        $role2 = Role::create(['name' => 'customer']);
        $role3 = Role::create(['name' => 'superadmin']);


        //Permissions
        $permissions = [
            'profile-index',
            'profile-security',
            'profile-change-password',
            'profile-destroy',
            'role-index',
            'role-create',
            'role-edit',
            'role-destroy',
            'permission-index',
            'permission-create',
            'permission-edit',
            'permission-destroy',
            'user-index',
            'user-create',
            'user-edit',
            'user-destroy'
            ,
        ];
       
        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        $role_permissions = Permission::pluck('id','id')->all();
     
        $role->givePermissionTo($role_permissions);
       
        $user->assignRole([$role3->id]);
    }
}
