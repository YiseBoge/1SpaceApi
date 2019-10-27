<?php

namespace App\Http\Controllers\Projects;

use App\Http\Controllers\Controller;
use App\Http\Resources\Projects\PMOResource;
use App\Models\Projects\ProjectManagementOrganization;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class PMOController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return AnonymousResourceCollection
     */
    public function index()
    {
        $data = ProjectManagementOrganization::paginate();
        return PMOResource::collection($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return PMOResource
     */
    public function store(Request $request)
    {
        $data = ProjectManagementOrganization::create([
            'company_id' => $request->input('company_id'),
            'title' => $request->input('title'),
            'description' => $request->input('description'),
        ]);

        $data->parent_pmo_id = $request->input('parent_pmo_id');

        if ($data->save()) {
            return new PMOResource($data);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return PMOResource
     */
    public function show($id)
    {
        $data = ProjectManagementOrganization::findOrFail($id);
        return new PMOResource($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return PMOResource
     */
    public function update(Request $request, $id)
    {
        $data = ProjectManagementOrganization::findOrFail($id);

        $data->title = $request->input('title');
        $data->description = $request->input('description');

        if ($data->save()) {
            return new PMOResource($data);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return PMOResource
     * @throws Exception
     */
    public function destroy($id)
    {
        $data = ProjectManagementOrganization::findOrFail($id);
        if ($data->delete()) {
            return new PMOResource($data);
        }
    }
}
