<?php

namespace App\Http\Controllers\Project;

use App\Http\Controllers\Controller;
use App\Http\Resources\Projects\ProjectCategoryResource;
use App\Models\Projects\ProjectCategory;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class ProjectCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return AnonymousResourceCollection
     */
    public function index()
    {
        $data = ProjectCategory::paginate();
        return ProjectCategoryResource::collection($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return ProjectCategoryResource
     */
    public function store(Request $request)
    {
        $data = ProjectCategory::create([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
        ]);

        if ($data->save()) {
            return new ProjectCategoryResource($data);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return ProjectCategoryResource
     */
    public function show($id)
    {
        $data = ProjectCategory::findOrFail($id);
        return new ProjectCategoryResource($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return ProjectCategoryResource
     */
    public function update(Request $request, $id)
    {
        $data = ProjectCategory::findOrFail($id);

        $data->name = $request->input('name');
        $data->description = $request->input('description');

        if ($data->save()) {
            return new ProjectCategoryResource($data);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return ProjectCategoryResource
     * @throws Exception
     */
    public function destroy($id)
    {
        $data = ProjectCategory::findOrFail($id);
        if ($data->delete()) {
            return new ProjectCategoryResource($data);
        }
    }
}
