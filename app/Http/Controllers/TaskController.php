<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Inertia\Inertia;
use App\Models\Project;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index(Request $request)
    {
        // If a project_id is provided, filter Tasks based on project
        $tasks = Task::when($request->project_id, function($query) use ($request) {
            return $query->where('project_id', $request->project_id);
        })->latest()->get();

        // Fetch all projects for the dropdown
        $projects = Project::all();

        return Inertia::render('Task/Index', [
            'tasks' => $tasks,
            'projects' => $projects,
            'selectedProject' => $request->project_id,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'project_id' => 'required|exists:projects,id',
        ]);

        Task::create([
            'title' => $request->title,
            'project_id' => $request->project_id,
        ]);

        return redirect()->route('projects.index');
    }

    public function update(Request $request, Task $task)
    {
        $task->update(['completed' => !$task->completed]);

        return redirect()->route('projects.index');
    }

    public function destroy(Task $task)
    {
        $task->delete();

        return redirect()->route('projects.index');
    }
}
