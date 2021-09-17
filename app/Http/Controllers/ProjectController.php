<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function createProject(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'duration' => 'required',
        ]);
        //Student Id + Create Data
        $student_id = auth()->user()->id;
        $project = new Project();
        $project->student_id = $student_id;
        $project->name = $request->name;
        $project->description = $request->description;
        $project->duration = $request->duration;
        $project->save();

        return response([
            'status' => 1,
            'message' => "Project created successfully"
        ]);
    }
    public function listProject()
    {
        $student_id = auth()->user()->id;
        $project = Project::where('student_id', $student_id)->get();
        return response([
            'status' => 1,
            'message' => 'All Projects',
            'data' => $project
        ]);
    }
    public function singleProject($id)
    {
        $student_id = auth()->user()->id;
        if (Project::where([
            'id' => $id,
            'student_id' => $student_id
        ])->exists()) {
            // $project = Project::find($id);
            $project = Project::where([
                'id' => $id,
                'student_id' => $student_id
            ])->first();
            return response([
                'status' => 1,
                'message' => 'Single Project',
                'data' => $project
            ]);
        } else {
            return response([
                'status' => 0,
                'message' => 'Project Not found'
            ]);
        }
    }
    public function deleteProject($id)
    {
        $student_id = auth()->user()->id;
        if (Project::where([
            'id' => $id,
            'student_id' => $student_id
        ])->exists()) {
            // $project = Project::find($id);
            $project = Project::where([
                'id' => $id,
                'student_id' => $student_id
            ])->first();
            $project->delete();
            return response([
                'status' => 1,
                'message' => 'Project has been deleted',
            ]);
        } else {
            return response([
                'status' => 0,
                'message' => 'Project Not found'
            ]);
        }
    }
}
