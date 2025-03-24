<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SchoolClassesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('school_classes')->insert([
            ['name' => '12P', 'year' => '2024'],
            ['name' => '12P', 'year' => '2024'],
            ['name' => '13P', 'year' => '2023'],
            ['name' => '13P', 'year' => '2023'],
            ['name' => '10P', 'year' => '2022'],
        ]);
    }
}
