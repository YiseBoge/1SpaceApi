<?php

namespace App\Http\Controllers\Projects;

use App\Http\Controllers\Controller;
use App\Http\Resources\Projects\FileCategoryResource;
use App\Models\Projects\FileCategory;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class FileCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return AnonymousResourceCollection
     */
    public function index()
    {
        $data = FileCategory::paginate();
        return FileCategoryResource::collection($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return FileCategoryResource
     */
    public function store(Request $request)
    {
        $data = FileCategory::create([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
        ]);
        $data->parent_category_id = $request->input('parent_category_id');

        return new FileCategoryResource($data);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return FileCategoryResource
     */
    public function show($id)
    {
        $data = FileCategory::findOrFail($id);
        return new FileCategoryResource($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return FileCategoryResource
     */
    public function update(Request $request, $id)
    {
        $data = FileCategory::findOrFail($id);

        $data->name = $request->input('name');
        $data->description = $request->input('description');
        $data->parent_category_id = $request->input('parent_category_id');

        if ($data->save()) {
            return new FileCategoryResource($data);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return FileCategoryResource
     * @throws Exception
     */
    public function destroy($id)
    {
        $data = FileCategory::findOrFail($id);
        if ($data->delete()) {
            return new FileCategoryResource($data);
        }
    }
}
