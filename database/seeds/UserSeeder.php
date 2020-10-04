<?php

//namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = Role::where('slug','basic-user')->first();
        $worker = Role::where('slug','worker')->first();
        $admin = Role::where('slug','admin')->first();
        
        $userOne = new User();
        $userOne->login = 'Igogor1299';
        $userOne->name = 'Kon v palto';
        $userOne->email = 'hourse1299@gmail.com';
        $userOne->type = 'front';
        $userOne->github = '';
        $userOne->city = '';
        $userOne->phone = '';
        $userOne->birthday = '08.10.04';
        $userOne->password = bcrypt('igogogog');
        $userOne->save();
        $userOne->roles()->syncWithoutDetaching($user);
        
        $userTwo = new User();
        $userTwo->login = 'Hapines2020';
        $userTwo->name = 'Office looser';
        $userTwo->email = 'lucky2020@gmail.com';
        $userTwo->type = 'back';
        $userTwo->github = '';
        $userTwo->city = '';
        $userTwo->phone = '';
        $userTwo->birthday = '03.10.01';
        $userTwo->password = bcrypt('trololol');
        $userTwo->save();
        $userTwo->roles()->syncWithoutDetaching($worker);
        
        $userThree = new User();
        $userThree->login = 'GodIam';
        $userThree->name = 'Code father';
        $userThree->email = 'ciciliya@protonmail.com';
        $userThree->type = 'back';
        $userThree->github = '';
        $userThree->city = '';
        $userThree->phone = '';
        $userThree->birthday = '01.10.02';
        $userThree->password = bcrypt('italia20');
        $userThree->save();
        $userThree->roles()->syncWithoutDetaching($admin);
    }
}
