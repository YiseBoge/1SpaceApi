<?php

namespace App\Http\Controllers\Accounts;

use App\Http\Controllers\Controller;
use App\Http\Resources\Accounts\FamilyStatusResource;
use App\Models\Accounts\FamilyStatus;
use App\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;

class FamilyStatusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return AnonymousResourceCollection
     */
    public function index()
    {
        $data = FamilyStatus::all();
        return FamilyStatusResource::collection($data);
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
     * @return FamilyStatusResource
     */
    public function store(Request $request)
    {
        $user = User::findOrFail($request->input('user_id'));

        $data = FamilyStatus::create([
            'status' => $request->input('status'),
        ]);

        if ($data->status == 'Married') {
            $data->partner_name = $request->input('partner_name');
        }

        if ($user->familyStatus()->save($data)) {
            return new FamilyStatusResource($data);
        }
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
