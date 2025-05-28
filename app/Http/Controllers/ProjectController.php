<?php

namespace App\Http\Controllers;

use App\Classes\ApiResponseClass;
use App\Http\Requests\storeProjectRequest;
use App\Models\Project;

class ProjectController extends Controller
{
    public function store(storeProjectRequest $request)
    {
        $validated = $request->validated();
        $project = Project::create($validated);

        return ApiResponseClass::sendResponse($project, 'Project created successfully', 201);
    }
}
