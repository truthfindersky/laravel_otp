<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Inertia\Inertia;
use Inertia\Response;
use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index(Request $request): Response
    {
        // Fetch the projects
        $projects = Project::latest()->get();

        // Fetch the Tasks related to the selected project (if any)
        $tasks = Task::when($request->project_id, function($query) use ($request) {
            return $query->where('project_id', $request->project_id);
        })->latest()->get();

        return Inertia::render('Projects/Index', [
            'projects' => $projects,
            'tasks' => $tasks,
            'selectedProject' => $request->project_id,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        Project::create([
            'name' => $request->name,
        ]);

        return redirect()->route('projects.index')->with('success', 'Project created successfully.');
    }

    public function destroy(Project $project)
    {
        $project->delete();

        return redirect()->route('projects.index')->with('success', 'Project deleted successfully.');
    }
}
