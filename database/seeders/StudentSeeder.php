<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class StudentSeeder extends Seeder
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
        ->create()->each(function ($student){
            $studentName = "Student " . $student->name;
            $student->update(['name' => $studentName]);
            $role = Role::whereName('student')->first();
            $student->assignRole($role);
        });
    }
}
