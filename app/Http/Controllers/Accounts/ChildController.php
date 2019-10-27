<?php

namespace App\Http\Controllers\Accounts;

use App\Http\Controllers\Controller;
use App\Http\Resources\Accounts\ChildResource;
use App\Models\Accounts\Child;
use App\Models\Accounts\FamilyStatus;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class ChildController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return AnonymousResourceCollection
     */
    public function index()
    {
        $data = Child::paginate();
        return ChildResource::collection($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return ChildResource
     */
    public function store(Request $request)
    {
        $family_status = FamilyStatus::findOrFail($request->input('family_status_id'));

        $data = Child::create([
            'name' => $request->input('name'),
            'sex' => $request->input('sex'),
            'birth_date' => $request->input('birth_date'),
        ]);

        if ($family_status->children()->save($data)) {
            return new ChildResource($data);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return ChildResource
     */
    public function show($id)
    {
        $data = Child::findOrFail($id);
        return new ChildResource($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return ChildResource
     */
    public function update(Request $request, $id)
    {
        $data = Child::findOrFail($id);

        $data->name = $request->input('name');
        $data->sex = $request->input('sex');
        $data->birth_date = $request->input('birth_date');

        if ($data->save()) {
            return new ChildResource($data);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return ChildResource
     * @throws Exception
     */
    public function destroy($id)
    {
        $data = Child::findOrFail($id);
        if ($data->delete()) {
            return new ChildResource($data);
        }
    }
}
