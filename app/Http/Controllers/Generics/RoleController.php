<?php

namespace App\Http\Controllers\Generics;

use App\Http\Controllers\Controller;
use App\Http\Resources\Generics\RoleResource;
use App\Models\Generics\Role;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return AnonymousResourceCollection
     */
    public function index()
    {
        $data = Role::all();
        return RoleResource::collection($data);
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
     * @return RoleResource
     */
    public function store(Request $request)
    {
        $data = Role::create([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'quantity_needed' => $request->input('quantity_needed'),
        ]);

        $data->remark = $request->input('remark');

        if ($data->save()) {
            return new RoleResource($data);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return RoleResource
     */
    public function show($id)
    {
        $data = Role::findOrFail($id);
        return new RoleResource($data);
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
     * @return RoleResource
     */
    public function update(Request $request, $id)
    {
        $data = Role::findOrFail($id);

        $data->name = $request->input('name');
        $data->description = $request->input('description');
        $data->quantity_needed = $request->input('quantity_needed');
        $data->remark = $request->input('remark');

        if ($data->save()) {
            return new RoleResource($data);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return RoleResource
     * @throws Exception
     */
    public function destroy($id)
    {
        $data = Role::findOrFail($id);
        if ($data->delete()) {
            return new RoleResource($data);
        }
    }
}
