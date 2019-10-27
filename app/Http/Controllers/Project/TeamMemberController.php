<?php

namespace App\Http\Controllers\Project;

use App\Http\Controllers\Controller;
use App\Http\Resources\Projects\TeamMemberResource;
use App\Models\Projects\TeamMember;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class TeamMemberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return AnonymousResourceCollection
     */
    public function index()
    {
        $data = TeamMember::paginate();
        return TeamMemberResource::collection($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return TeamMemberResource
     */
    public function store(Request $request)
    {
        $data = TeamMember::create([
            'pmo_id' => $request->input('pmo_id'),
            'user_id' => $request->input('user_id'),
            'professional_role' => $request->input('professional_role'),
            'task_description' => $request->input('task_description'),
        ]);

        if ($data->save()) {
            return new TeamMemberResource($data);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return TeamMemberResource
     */
    public function show($id)
    {
        $data = TeamMember::findOrFail($id);
        return new TeamMemberResource($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return TeamMemberResource
     */
    public function update(Request $request, $id)
    {
        $data = TeamMember::findOrFail($id);

        $data->professional_role = $request->input('professional_role');
        $data->task_description = $request->input('task_description');

        if ($data->save()) {
            return new TeamMemberResource($data);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return TeamMemberResource
     * @throws Exception
     */
    public function destroy($id)
    {
        $data = TeamMember::findOrFail($id);
        if ($data->delete()) {
            return new TeamMemberResource($data);
        }
    }
}
