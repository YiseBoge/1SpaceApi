<?php

namespace App\Http\Controllers\Companies;

use App\Http\Controllers\Controller;
use App\Http\Resources\Companies\DepartmentResource;
use App\Models\Companies\Department;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\Auth;

class DepartmentController extends Controller
{
    public function __construct()
    {
        $this->middleware('jwt.auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return AnonymousResourceCollection
     */
    public function index()
    {
        $data =  Auth::user()->company->departments();

        if ($name = request()->query('name', null)) {
            $data->where('name', 'like', "%$name%");
        }

        return request()->has('no_pagination') ? DepartmentResource::collection($data->get()) : DepartmentResource::collection($data->paginate());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return DepartmentResource
     */
    public function store(Request $request)
    {
        $this->middleware('auth.permission:can_add_department');

        $company_id = auth()->user()->company->id;

        $data = new Department([
            'company_id' => $company_id,
            'name' => $request->input('name'),
            'description' => $request->input('description'),
        ]);

        $data->remark = $request->input('remark');
        $data->parent_department_id = $request->input('parent_department_id');
        $data->save();
        return new DepartmentResource($data);
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
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return DepartmentResource
     */
    public function update(Request $request, $id)
    {
        $this->middleware('auth.permission:can_edit_department');

        $data = Department::findOrFail($id);
        $parent_department_id = $request->input('parent_department_id');

        if ($data->company->id != auth()->user()->company->id) {
            return response(['message' => "You can not edit this department"], 403);
        }

        if ($data->subDepartments()->where('id', $parent_department_id)->exists()) {
            return response(['message' => 'Parent department can not be sub-department'], 400);
        }

        if ($data->id == $parent_department_id){
            return response(['message' => 'Department can not be parent department of itself'], 400);
        }

        $data->name = $request->input('name');
        $data->description = $request->input('description');
        $data->remark = $request->input('remark');
        $data->parent_department_id = $request->input('parent_department_id');

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
        $this->middleware('auth.permission:can_delete_department');

        $data = Department::findOrFail($id);

        if ($data->company->id != auth()->user()->company->id) {
            return response(['message' => "You can not delete this department"], 403);
        }

        if ($data->delete()) {
            return new DepartmentResource($data);
        }
    }
}
