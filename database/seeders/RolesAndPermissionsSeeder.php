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

    
       //SuperAdmin Seeder
        $superadmin = User::create([
            'name' => 'Sankalp Karna', 
            'email' => 'karn.sankalp@gmail.com',
            'password' => bcrypt('salman'),
            'mobile_number' => '9802100617',
            'is_email_verified' =>'1'
        ]);

        //Admin Seeder
        $admin = User::create([
            'name' => 'Admin', 
            'email' => 'admin@admin.com',
            'password' => bcrypt('adminadmin'),
            'mobile_number' => '9802100617',
            'is_email_verified' =>'1'
        ]);

        //Provider Seeder

        $provider = User::create([
            'name' => 'Provider', 
            'email' => 'provider@gmail.com',
            'password' => bcrypt('provider'),
            'mobile_number' => '9802100617',
            'is_email_verified' =>'1'
        ]);

        //Customer Seeder

        $customer = User::create([
            'name' => 'Customer', 
            'email' => 'customer@gmail.com',
            'password' => bcrypt('customer'),
            'mobile_number' => '9802100617',
            'is_email_verified' =>'1'
        ]);

        // create roles and assign created permissions

        $superadminrole = Role::create(['name' => 'superadmin']);
        $adminrole  = Role::create(['name' => 'admin']);
        $providerrole = Role::create(['name' => 'provider']);
        $customerrole = Role::create(['name' => 'customer']);
        
        $superadmin->assignRole([$superadminrole->id]);
        $admin->assignRole([$adminrole->id]);
        $provider->assignRole([$providerrole->id]);
        $customer->assignRole([$customerrole->id]);

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
        ];
       
        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        //Assign permissions from the admin portal or from below code.
        /*
        $role_permissions = Permission::pluck('id','id')->all();
     
        $role->givePermissionTo($role_permissions);

        */
       
    }
}
