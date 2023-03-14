<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProjectStoreRequest;
use App\Http\Requests\ProjectUpdateRequest;
use App\Http\Resources\ProjectResource;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProjectController extends Controller
{
    public function index(): object
    {
        $companies = Project::paginate(3);
        return ProjectResource::collection($companies);
    }

    public function show(Project $project): object
    {
        return (new ProjectResource($project));
    }
    public function store(ProjectStoreRequest $request): object
    {
        $data = $request->validated();
        $project = Project::create($data);
        return (new ProjectResource($project));
    }
    public function update(ProjectUpdateRequest $request, Project $project): object
    {
        $data = $request->validated();
        $project->update($data);
        return (new ProjectResource($project));
    }

    public function delete(Project $project): mixed
    {
        DB::table('project_user')->where('project_id', $project->id)->delete();
        $project->delete();
        return response('', 204);
    }
}
