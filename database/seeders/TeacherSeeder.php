<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class TeacherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::factory()
        ->count(50)
        ->create()->each(function ($teacher){
            $teacherName = "Teacher " . $teacher->id;
            $teacher->update(['name' => $teacherName]);
            $role = Role::whereName('teacher')->first();
            $teacher->assignRole($role);
        });
    }
}
