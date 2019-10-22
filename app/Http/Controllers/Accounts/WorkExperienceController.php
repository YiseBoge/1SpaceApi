<?php

namespace App\Http\Controllers\Accounts;

use App\Http\Controllers\Controller;
use App\Http\Resources\Accounts\WorkExperienceResource;
use App\Models\Accounts\WorkExperience;
use App\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;

class WorkExperienceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return AnonymousResourceCollection
     */
    public function index()
    {
        $data = WorkExperience::paginate();
        return WorkExperienceResource::collection($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return WorkExperienceResource
     */
    public function store(Request $request)
    {
        $user = User::findOrFail($request->input('user_id'));

        $data = WorkExperience::create([
            'company_name' => $request->input('company_name'),
            'department' => $request->input('department'),
            'position' => $request->input('position'),
            'role' => $request->input('role'),
        ]);

        $data->start_date = $request->input('start_date');
        $data->end_date = $request->input('end_date');

        if ($user->workExperiences()->save($data)) {
            return new WorkExperienceResource($data);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return WorkExperienceResource
     */
    public function show($id)
    {
        $data = WorkExperience::findOrFail($id);
        return new WorkExperienceResource($data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return WorkExperienceResource
     */
    public function update(Request $request, $id)
    {
        $data = WorkExperience::findOrFail($id);

        $data->company_name = $request->input('company_name');
        $data->department = $request->input('department');
        $data->position = $request->input('position');
        $data->role = $request->input('role');
        $data->start_date = $request->input('start_date');
        $data->end_date = $request->input('end_date');

        if ($data->save()) {
            return new WorkExperienceResource($data);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return WorkExperienceResource
     * @throws Exception
     */
    public function destroy($id)
    {
        $data = WorkExperience::findOrFail($id);
        if ($data->delete()) {
            return new WorkExperienceResource($data);
        }
    }

    /**
     * Get the resource with the specified user id.
     *
     * @param int $userId
     * @return AnonymousResourceCollection
     */
    public function getByUserId($userId)
    {
        $data = WorkExperience::where('user_id', $userId)->get();
        return WorkExperienceResource::collection($data);
    }
}
