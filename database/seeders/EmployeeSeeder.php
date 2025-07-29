<?php

namespace Database\Seeders;

use App\Models\Division;
use App\Models\Employee;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $divisionIds = Division::pluck('id')->toArray();
        Employee::factory(20)->create([
            'division_id' => fake()->randomElement($divisionIds),
        ]);
    }

}
