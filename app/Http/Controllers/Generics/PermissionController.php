<?php

namespace App\Http\Controllers\Generics;

use App\Http\Controllers\Controller;
use App\Http\Resources\Generics\PermissionResource;
use App\Models\Generics\Permission;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return AnonymousResourceCollection
     */
    public function index()
    {
        $data = Permission::all();
        return PermissionResource::collection($data);
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
     * @return PermissionResource
     */
    public function store(Request $request)
    {
        $data = Permission::create([
            'action' => $request->input('action'),
        ]);

        if ($data->save()) {
            return new PermissionResource($data);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return PermissionResource
     */
    public function show($id)
    {
        $data = Permission::findOrFail($id);
        return new PermissionResource($data);
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
     * @return PermissionResource
     */
    public function update(Request $request, $id)
    {
        $data = Permission::findOrFail($id);

        $data->action = $request->input('action');

        if ($data->save()) {
            return new PermissionResource($data);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return PermissionResource
     * @throws Exception
     */
    public function destroy($id)
    {
        $data = Permission::findOrFail($id);
        if ($data->delete()) {
            return new PermissionResource($data);
        }
    }
}
