<?php

namespace App\Http\Controllers\Accounts;

use App\Http\Controllers\Controller;
use App\Http\Resources\Accounts\WorkExperienceResource;
use App\Models\Accounts\WorkExperience;
use App\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class WorkExperienceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return AnonymousResourceCollection
     */
    public function index()
    {
        $filters = (array) json_decode(request()->input('filters'));
        $queries = [];

        foreach($filters as $key => $value) $queries[] = [$key, 'like', "%$value%"];
        
        $data = WorkExperience::where($queries);

        return request()->has('no_pagination') ? WorkExperienceResource::collection($data->get()) : WorkExperienceResource::collection($data->paginate());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return WorkExperienceResource
     */
    public function store(Request $request)
    {
        User::findOrFail($request->input('user_id'));

        $data = WorkExperience::create([
            'user_id' => $request->input('user_id'),
            'company_name' => $request->input('company_name'),
            'department' => $request->input('department'),
            'position' => $request->input('position'),
            'role' => $request->input('role'),
            'start_date' => $request->input('start_date'),
        ]);
        $data->end_date = $request->input('end_date');

        return new WorkExperienceResource($data);
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
}
