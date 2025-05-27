<?php

namespace App\Http\Controllers;

use App\Http\Requests\storeProjectRequest;
use App\Models\Project;

class ProjectController extends Controller
{
    public function store(storeProjectRequest $request)
    {
        $validated = $request->validated();
        $project = Project::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Project created successfully',
            'data' => $project
        ], 201);
    }
}
