<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\User;


class ProjectController extends Controller
{
    //

    public function index()
    {
        $projects = Project::all();
        return response()->json($projects);
    }



    // Get a specific project by ID
    public function show($id)
    {
        $project = Project::find($id);
        if (!$project) {
            return response()->json(['error' => 'Project not found'], 404);
        }
        return response()->json($project);
    }



    // Create a new project
    public function store(Request $request)
    {
        $project = Project::create($request->all());
        return response()->json($project, 201);
    }

  


    
    public function getCurrentProjectById($id)
    {

    
       // Retrieve projects associated with the given user ID and current status
       $projects = Project::where('user_id', $id)
       ->where('status', 'current')
       ->get();

        if ($projects) {
            return response()->json($projects, 200);
        } else {
            return response()->json(['message' => 'Project not found'], 404);
        }
    }


   


    public function update(Request $request)
    {
        // Retrieve the data from the request
        $requestData = $request->all();

        // Find the project to update based on some criteria (e.g., project name)
        $project = Project::where('id', $requestData['id'])->first();

        if ($project) {
            // Update the project with the new data
            $project->update($requestData);

            return response()->json(['message' => 'Project updated successfully'], 200);
        } else {
            return response()->json(['message' => 'Project not found'], 404);
        }
    }


    public function select($user_id)
    {
        // Retrieve projects associated with the given user ID
        $projects = Project::where('user_id', $user_id)->get();

        // Return the projects as JSON response
        return response()->json($projects);
    }


    

    // Delete a project
    public function destroy($id)
    {
        $project = Project::find($id);
        if (!$project) {
            return response()->json(['error' => 'Project not found'], 404);
        }
        $project->delete();
        return response()->json(['message' => 'Project deleted']);
    }


}