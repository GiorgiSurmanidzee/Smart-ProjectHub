<?php

namespace App\Http\Controllers;

use App\Classes\ApiResponseClass;
use App\Http\Requests\storeOrganizationRequest;
use App\Models\Organization;

class OrganizationController extends Controller
{
    public function store(storeOrganizationRequest $request)
    {
        $validated = $request->validated();
        $organization = Organization::create($validated);

        return ApiResponseClass::sendResponse($organization, 'Organization created successfully!', 201);
    }
}
