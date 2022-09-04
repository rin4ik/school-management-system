<?php

namespace Database\Seeders;
use App\Models\Grade;
use App\Models\Group;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GradeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Group::get()->each(function($group) {
            $group->students()->get()->each(function($student) use ($group){
                $group->subjects()->get()->each(function($subject) use ($group, $student){
                    $teacher = User::role('teacher')->inRandomOrder()->first();
                    Grade::create([
                        'subject_id' => $subject->id,
                        'student_id' => $student->id,
                        'group_id' => $group->id,
                        'teacher_id' => $teacher->id,
                        'mark' => rand(1, 5)
                    ]);
                });
            });
        });
    }
}
