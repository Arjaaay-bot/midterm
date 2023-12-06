<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Project;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::all();
        return view("admin.project")->with("projects", $projects);
        
    }

    public function store(Request $request)
    {
        Project::create($request->all());
        return redirect()->route('admin.projects.index');
    }


    public function update(Request $request, Project $project)
    {
        $project->update($request->all());

        return redirect()->route('admin.projects.index');
    }

    public function destroy(Project $project)
    {
        $project->delete();
        return redirect()->route('admin.projects.index')->with('success', 'Project deleted successfully.');
    }

    public function getTotalProjects()
    {
        $totalProjects = Project::count();
        return response()->json(['totalProjects' => $totalProjects]);
    }

        public function nextMonthAnalytics()
        {
            $nextMonthProjects = Project::where(function ($query) {
                    $query->whereMonth('project_start_date', now()->addMonth()->month)
                        ->orWhereMonth('project_end_date', now()->addMonth()->month);
                })
                ->count();

            return response()->json(['nextMonthProjects' => $nextMonthProjects]);
        }

}
