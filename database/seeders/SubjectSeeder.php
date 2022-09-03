<?php

namespace Database\Seeders;

use App\Models\Subject;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SubjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $subjects = [
            ['name' => 'English'],
            ['name' => 'Math'],
            ['name' => 'Art'],
            ['name' => 'Piano'],
            ['name' => 'Music'],
            ['name' => 'Geometry'],
            ['name' => 'Programming'],
            ['name' => 'Russian'],
            ['name' => 'Literature'],
        ];
        Subject::insert($subjects);
    }
}
