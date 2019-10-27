<?php

namespace App\Http\Controllers\Projects;

use App\Http\Controllers\Controller;
use App\Http\Resources\Projects\ProjectResource;
use App\Models\Projects\Project;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return AnonymousResourceCollection
     */
    public function index()
    {
        $data = Project::paginate();
        return ProjectResource::collection($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return ProjectResource
     */
    public function store(Request $request)
    {
        $data = Project::create([
            'pmo_id' => $request->input('pmo_id'),
            'project_category_id' => $request->input('project_category_id'),
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'client' => $request->input('client'),
            'start_date' => $request->input('start_date'),
        ]);

        $data->latitude = $request->input('latitude');
        $data->longitude = $request->input('longitude');

        if ($data->save()) {
            return new ProjectResource($data);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return ProjectResource
     */
    public function show($id)
    {
        $data = Project::findOrFail($id);
        return new ProjectResource($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return ProjectResource
     */
    public function update(Request $request, $id)
    {
        $data = Project::findOrFail($id);

        $data->name = $request->input('name');
        $data->description = $request->input('description');
        $data->client = $request->input('client');
        $data->start_date = $request->input('start_date');
        $data->latitude = $request->input('latitude');
        $data->longitude = $request->input('longitude');

        if ($data->save()) {
            return new ProjectResource($data);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return ProjectResource
     * @throws Exception
     */
    public function destroy($id)
    {
        $data = Project::findOrFail($id);
        if ($data->delete()) {
            return new ProjectResource($data);
        }
    }
}
