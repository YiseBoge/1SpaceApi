<?php

namespace App\Http\Controllers\Accounts;

use App\Http\Controllers\Controller;
use App\Http\Resources\Accounts\EducationStatusResource;
use App\Models\Accounts\EducationStatus;
use App\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;

class EducationStatusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return AnonymousResourceCollection
     */
    public function index()
    {
        $data = EducationStatus::paginate();
        return EducationStatusResource::collection($data);
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
     * @return EducationStatusResource
     */
    public function store(Request $request)
    {
        $user = User::findOrFail($request->input('user_id'));

        $data = new EducationStatus([
            'education_level' => $request->input('education_level'),
            'field_of_study' => $request->input('field_of_study'),
            'school_name' => $request->input('school_name'),
        ]);

        $data->start_date = $request->input('start_date');
        $data->end_date = $request->input('end_date');

        if ($user->educationStatuses()->save($data)) {
            return new EducationStatusResource($data);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return EducationStatusResource
     */
    public function show($id)
    {
        $data = EducationStatus::findOrFail($id);
        return new EducationStatusResource($data);
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
     * @return EducationStatusResource
     */
    public function update(Request $request, $id)
    {
        $data = EducationStatus::findOrFail($id);

        $data->education_level = $request->input('education_level');
        $data->field_of_study = $request->input('field_of_study');
        $data->school_name = $request->input('school_name');
        $data->start_date = $request->input('start_date');
        $data->end_date = $request->input('end_date');

        if ($data->save()) {
            return new EducationStatusResource($data);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return EducationStatusResource
     * @throws Exception
     */
    public function destroy($id)
    {
        $data = EducationStatus::findOrFail($id);
        if ($data->delete()) {
            return new EducationStatusResource($data);
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
        $data = EducationStatus::where('user_id', $userId)->get();
        return EducationStatusResource::collection($data);
    }
}
