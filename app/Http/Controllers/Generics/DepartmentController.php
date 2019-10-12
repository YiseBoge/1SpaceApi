<?php

namespace App\Http\Controllers\Generics;

use App\Http\Controllers\Controller;
use App\Http\Resources\Generics\DepartmentResource;
use App\Models\Generics\Department;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return AnonymousResourceCollection
     */
    public function index()
    {
        $data = Department::all();
        return DepartmentResource::collection($data);
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
     * @return DepartmentResource
     */
    public function store(Request $request)
    {
        $data = Department::create([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
        ]);

        $data->remark = $request->input('remark');

        if ($data->save()) {
            return new DepartmentResource($data);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return DepartmentResource
     */
    public function show($id)
    {
        $data = Department::findOrFail($id);
        return new DepartmentResource($data);
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
     * @return DepartmentResource
     */
    public function update(Request $request, $id)
    {
        $data = Department::findOrFail($id);

        $data->name = $request->input('name');
        $data->description = $request->input('description');
        $data->remark = $request->input('remark');

        if ($data->save()) {
            return new DepartmentResource($data);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return DepartmentResource
     * @throws Exception
     */
    public function destroy($id)
    {
        $data = Department::findOrFail($id);
        if ($data->delete()) {
            return new DepartmentResource($data);
        }
    }
}
