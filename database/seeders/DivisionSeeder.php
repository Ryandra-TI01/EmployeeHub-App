<?php

namespace Database\Seeders;

use App\Models\Division;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DivisionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $divisions = [
            ['name' => 'Human Resources'],
            ['name' => 'Finance'],
            ['name' => 'Engineering'],
            ['name' => 'Marketing'],
            ['name' => 'Sales'],
        ];
        foreach ($divisions as $division) {
            Division::create($division);
        }
    }
}
