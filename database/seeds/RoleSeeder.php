<?php

//namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $readDepartments = Permission::where('slug','read-departments')->first();
        $readDepartmentWorkers = Permission::where('slug','read-department-workers')->first();
        $manageEntities = Permission::where('slug','manage-entities')->first();
        
        $user = new Role();
        $user->name = 'Basic user';
        $user->slug = 'basic';
        $user->save();
        $user->permissions()->syncWithoutDetaching($readDepartments);
        
        $worker = new Role();
        $worker->name = 'Worker';
        $worker->slug = 'worker';
        $worker->save();
        $user->permissions()->syncWithoutDetaching($readDepartmentWorkers);
        
        $admin = new Role();
        $admin->name = 'Admin';
        $admin->slug = 'admin';
        $admin->save();
        $user->permissions()->syncWithoutDetaching($readDepartments);
        $user->permissions()->syncWithoutDetaching($readDepartmentWorkers);
        $user->permissions()->syncWithoutDetaching($manageEntities);
    }
}
