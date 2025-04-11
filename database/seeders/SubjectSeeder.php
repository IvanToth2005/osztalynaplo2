<?php

namespace Database\Seeders;

use App\Models\Subject;
use App\Models\SchoolClass;
use Illuminate\Database\Seeder;

class SubjectSeeder extends Seeder
{
    public function run(): void
    {
        // Tantárgyak létrehozása
        $subjects = [
            ['name' => 'Mathematics'],
            ['name' => 'Physics'],
            ['name' => 'Chemistry'],
            ['name' => 'Biology'],
            ['name' => 'History'],
            ['name' => 'Geography'],
            ['name' => 'English'],
            ['name' => 'Computer Science'],
        ];

        // Tantárgyak létrehozása (ha még nem léteznek)
        foreach ($subjects as $subject) {
            Subject::firstOrCreate($subject);
        }

        // Minden osztály kapcsolatainak törlése
        SchoolClass::each(function ($class) {
            $class->subjects()->detach();
        });

        // Új kapcsolatok létrehozása
        $subjectIds = Subject::pluck('id')->toArray();
        
        SchoolClass::each(function ($class) use ($subjectIds) {
            $class->subjects()->sync($subjectIds);
        });
    }
}