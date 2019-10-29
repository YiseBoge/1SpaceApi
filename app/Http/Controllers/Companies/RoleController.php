<?php

namespace App\Http\Controllers\Companies;

use App\Http\Controllers\Controller;
use App\Http\Resources\Companies\RoleResource;
use App\Models\Companies\Role;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return AnonymousResourceCollection
     */
    public function index()
    {
        $data = Role::select();

        if ($name = request()->query('name', null)) $data->where('name', 'like', "%$name%");

        return request()->has('no_pagination') ? RoleResource::collection($data->get()) : RoleResource::collection($data->paginate());
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
            'company_id' => $request->input('company_id'),
            'name' => $request->input('name'),
            'description' => $request->input('description'),

            'can_add_user' => $request->has('can_add_user'),
            'can_edit_user' => $request->has('can_edit_user'),
            'can_delete_user' => $request->has('can_delete_user'),
            'can_activate_user' => $request->has('can_activate_user'),
            'can_deactivate_user' => $request->has('can_deactivate_user'),
            'can_assign_user_admin' => $request->has('can_assign_user_admin'),
            'can_generate_user_cv' => $request->has('can_generate_user_cv'),
            'can_generate_user_report' => $request->has('can_generate_user_report'),

            'can_assign_organogram_admin' => $request->has('can_assign_organogram_admin'),
            'can_add_department' => $request->has('can_add_department'),
            'can_edit_department' => $request->has('can_edit_department'),
            'can_delete_department' => $request->has('can_delete_department'),
            'can_add_position' => $request->has('can_add_position'),
            'can_edit_position' => $request->has('can_edit_position'),
            'can_delete_position' => $request->has('can_delete_position'),
            'can_add_professional_role' => $request->has('can_add_professional_role'),
            'can_edit_professional_role' => $request->has('can_edit_professional_role'),
            'can_delete_professional_role' => $request->has('can_delete_professional_role'),

            'can_assign_project_admin' => $request->has('can_assign_project_admin'),
            'can_add_project' => $request->has('can_add_project'),
            'can_edit_project' => $request->has('can_edit_project'),
            'can_delete_project' => $request->has('can_delete_project'),
            'can_evaluate_project' => $request->has('can_evaluate_project'),
            'can_generate_project_report' => $request->has('can_generate_project_report'),
        ]);
        $data->remark = $request->input('remark');

        return new RoleResource($data);
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
        $data->remark = $request->input('remark');

        $data->can_add_user = $request->has('can_add_user');
        $data->can_edit_user = $request->has('can_edit_user');
        $data->can_delete_user = $request->has('can_delete_user');
        $data->can_activate_user = $request->has('can_activate_user');
        $data->can_deactivate_user = $request->has('can_deactivate_user');
        $data->can_assign_user_admin = $request->has('can_assign_user_admin');
        $data->can_generate_user_cv = $request->has('can_generate_user_cv');
        $data->can_generate_user_report = $request->has('can_generate_user_report');

        $data->can_assign_organogram_admin = $request->has('can_assign_organogram_admin');
        $data->can_add_department = $request->has('can_add_department');
        $data->can_edit_department = $request->has('can_edit_department');
        $data->can_delete_department = $request->has('can_delete_department');
        $data->can_add_position = $request->has('can_add_position');
        $data->can_edit_position = $request->has('can_edit_position');
        $data->can_delete_position = $request->has('can_delete_position');
        $data->can_add_professional_role = $request->has('can_add_professional_role');
        $data->can_edit_professional_role = $request->has('can_edit_professional_role');
        $data->can_delete_professional_role = $request->has('can_delete_professional_role');

        $data->can_assign_project_admin = $request->has('can_assign_project_admin');
        $data->can_add_project = $request->has('can_add_project');
        $data->can_delete_project = $request->has('can_delete_project');
        $data->can_evaluate_project = $request->has('can_evaluate_project');
        $data->can_generate_project_report = $request->has('can_generate_project_report');

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
