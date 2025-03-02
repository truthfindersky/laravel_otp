<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Project;
use Illuminate\Support\Facades\DB;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $projects = [
            ['name' => 'Laravel Project'],
            ['name' => 'Vue Project'],
            ['name' => 'Inertia Project'],
            ['name' => 'Tailwind CSS Project'],
        ];

        Project::insert($projects);
    }
}
