<?php

//namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $readDepartments = new Permission();
        $readDepartments->name = 'Read departments';
        $readDepartments->slug = 'read-departments';
        $readDepartments->save();
        
        $readDepartmentWorkers = new Permission();
        $readDepartmentWorkers->name = 'Read department workers';
        $readDepartmentWorkers->slug = 'read-department-workers';
        $readDepartmentWorkers->save();
        
        $manageEntities = new Permission();
        $manageEntities->name = 'Manage entities';
        $manageEntities->slug = 'manage-entities';
        $manageEntities->save();
    }
}
