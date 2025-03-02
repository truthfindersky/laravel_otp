<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Task;

class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Task::create([
            'title' => 'Laravel Scaffolding',
            'project_id' => 1,
            'completed' => true,
        ]);

        Task::create([
            'title' => 'Setup SMTP',
            'project_id' => 1,
            'completed' => true,
        ]);

        Task::create([
            'title' => 'Generate OTP using helpers.php',
            'project_id' => 1,
            'completed' => true,
        ]);

        Task::create([
            'title' => 'OTP Migration',
            'project_id' => 1,
            'completed' => true,
        ]);

        Task::create([
            'title' => 'OTP Notification',
            'project_id' => 1,
            'completed' => true,
        ]);





        Task::create([
            'title' => 'Projects Index.vue',
            'project_id' => 2,
            'completed' => true,
        ]);

        Task::create([
            'title' => 'Task Index.vue',
            'project_id' => 2,
            'completed' => true,
        ]);
    }
}
