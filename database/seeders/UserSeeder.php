<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [
                'name' => 'Student Mirakhmad',
                'email' => 'student@school.com',
                'role' => 'student',
                'password' => bcrypt('password'),
            ],
            [
                'name' => 'Teacher Me',
                'email' => 'teacher@school.com',
                'role' => 'teacher',
                'password' => bcrypt('password'),
            ],
            [
                'name' => 'Director Enter Engineering',
                'email' => 'director@school.com',
                'role' => 'director',
                'password' => bcrypt('password'),
            ],
        ];
        $roles = [
            ['name' => 'director'],
            ['name' => 'teacher'],
            ['name' => 'student'],
        ];
        $permissions = [
            ['name' => 'edit subjects', 'able' => ['director']],
            ['name' => 'edit groups', 'able' => ['director']],
            ['name' => 'edit students', 'able' => ['director']],
            ['name' => 'edit teachers', 'able' => ['director']],
            ['name' => 'edit grades', 'able' => ['director', 'teacher']],
            ['name' => 'see subjects', 'able' => ['director', 'teacher', 'student']],
            ['name' => 'see schedule', 'able' => ['director', 'teacher', 'student']],
            ['name' => 'see grades', 'able' => ['director', 'teacher', 'student']],
            ['name' => 'see groups', 'able' => ['director', 'teacher']],
            ['name' => 'see students', 'able' => ['director', 'teacher']],
            ['name' => 'see teachers', 'able' => ['director']],
            ['name' => 'see stats', 'able' => ['director']],
            ['name' => 'edit group-subjects', 'able' => ['director']],
            ['name' => 'see group-subjects', 'able' => ['director', 'teacher']],            
        ];
        foreach ($roles as $role) {
            Role::create($role);
        }
        foreach ($permissions as $permission) {
            $abilities = $permission['able'];
            unset($permission['able']);
            $permission = Permission::create($permission);

            foreach ($abilities as $able) {
                $role = Role::whereName($able)->first();
                if ($role) {
                    $role->givePermissionTo($permission);
                }
            }
        }

        foreach ($users as $key => $user) {
            $role = Role::whereName($user['role'])->first();
            unset($user['role']);
            $user = User::create($user);

            if ($role) {
                $user->assignRole($role);
            }
        }
    }
}
