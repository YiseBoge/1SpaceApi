<?php

namespace App\Http\Controllers\Accounts;

use App\Http\Controllers\Controller;
use App\Http\Resources\Accounts\FamilyStatusResource;
use App\Models\Accounts\FamilyStatus;
use App\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class FamilyStatusController extends Controller
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
        
        $data = FamilyStatus::where($queries);

        return request()->has('no_pagination') ? FamilyStatusResource::collection($data->get()) : FamilyStatusResource::collection($data->paginate());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return FamilyStatusResource
     */
    public function store(Request $request)
    {
        User::findOrFail($request->input('user_id'));

        $data = FamilyStatus::create([
            'user_id' => $request->input('status'),
            'status' => $request->input('status'),
        ]);
        if ($data->status == 'Married') $data->partner_name = $request->input('partner_name');

        return new FamilyStatusResource($data);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return FamilyStatusResource
     */
    public function show($id)
    {
        $data = FamilyStatus::findOrFail($id);
        return new FamilyStatusResource($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return FamilyStatusResource
     */
    public function update(Request $request, $id)
    {
        $data = FamilyStatus::findOrFail($id);

        $data->status = $request->input('status');
        $data->partner_name = $request->input('partner_name');

        if ($data->save()) {
            return new FamilyStatusResource($data);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return FamilyStatusResource
     * @throws Exception
     */
    public function destroy($id)
    {
        $data = FamilyStatus::findOrFail($id);
        if ($data->delete()) {
            return new FamilyStatusResource($data);
        }
    }
}
