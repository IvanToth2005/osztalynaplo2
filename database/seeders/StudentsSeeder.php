<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class StudentsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('students')->insert([
            ['name' => 'John Doe', 'class_id' => 1, 'sex' => 'M'],
            ['name' => 'Jane Smith', 'class_id' => 1, 'sex' => 'F'],
            ['name' => 'Alice Brown', 'class_id' => 2, 'sex' => 'F'],
            ['name' => 'Bob Johnson', 'class_id' => 2, 'sex' => 'M'],
            ['name' => 'Charlie White', 'class_id' => 3, 'sex' => 'M'],
        ]);
    }
}
