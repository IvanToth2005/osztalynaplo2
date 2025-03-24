<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ClassSubjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('classes_subjects')->insert([
            ['class_id' => 1, 'subject_id' => 1],
            ['class_id' => 1, 'subject_id' => 2],
            ['class_id' => 2, 'subject_id' => 1],
            ['class_id' => 2, 'subject_id' => 3],
            ['class_id' => 3, 'subject_id' => 2],
        ]);
    }
}