<?php

namespace App\Http\Controllers\Accounts;

use App\Http\Controllers\Controller;
use App\Http\Resources\Accounts\EducationStatusResource;
use App\Models\Accounts\EducationStatus;
use App\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class EducationStatusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return AnonymousResourceCollection
     */
    public function index()
    {
        $data = EducationStatus::with([]);

        if ($user_id = request()->query('user_id', null)) $data->where('user_id', '=', $user_id);

        if ($personal_name = request()->query('personal_name', null)) $data->where('personal_name', 'like', "%$personal_name%");
        if ($father_name = request()->query('father_name', null)) $data->where('father_name', 'like', "%$father_name%");
        if ($grand_father_name = request()->query('grand_father_name', null)) $data->where('grand_father_name', 'like', "%$grand_father_name%");
        if ($sex = request()->query('sex', null)) $data->where('sex', 'like', "%$sex%");

        return request()->has('no_pagination') ? EducationStatusResource::collection($data->get()) : EducationStatusResource::collection($data->paginate());
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

        $data = EducationStatus::create([
            'user_id' => $request->input('user_id'),
            'education_level' => $request->input('education_level'),
            'field_of_study' => $request->input('field_of_study'),
            'school_name' => $request->input('school_name'),
            'start_date' => $request->input('start_date'),
            'end_date' => $request->input('end_date')
        ]);

        return new EducationStatusResource($data);
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
