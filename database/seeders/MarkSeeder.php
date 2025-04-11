<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class MarkSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('marks')->insert([
            ['subject_id' => 1, 'student_id' => 1, 'mark' => '4', 'date' => '2025-03-01'],
            ['subject_id' => 2, 'student_id' => 1, 'mark' => '5', 'date' => '2025-03-02'],
            ['subject_id' => 1, 'student_id' => 2, 'mark' => '3', 'date' => '2025-03-03'],
            ['subject_id' => 3, 'student_id' => 2, 'mark' => '5', 'date' => '2025-03-04'],
            ['subject_id' => 2, 'student_id' => 3, 'mark' => '5', 'date' => '2025-03-05'],
        ]);
    }
}