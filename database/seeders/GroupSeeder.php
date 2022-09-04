<?php

namespace Database\Seeders;

use App\Models\Group;
use App\Models\Subject;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $groups = [
            ['name' => 'IN-22'],
            ['name' => 'IN-24'],
            ['name' => 'IN-25'],
            ['name' => 'IN-26'],
            ['name' => 'IN-27'],
            ['name' => 'IN-28'],
            ['name' => 'IN-29'],
            ['name' => 'IN-31'],
            ['name' => 'IN-32'],
            ['name' => 'IN-33'],
            ['name' => 'IN-34'],
            ['name' => 'IN-36'],
        ];
        Group::insert($groups);
        Group::get()->each(function($group) {
            $users = User::doesntHave('groups')->inRandomOrder()->role('student')->take(15)->pluck('id');
            $subjects = Subject::inRandomOrder()->take(5)->pluck('id');

            $group->students()->attach($users);
            $group->subjects()->attach($subjects);
        });
    }
}
