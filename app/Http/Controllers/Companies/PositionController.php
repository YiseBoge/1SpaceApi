<?php

namespace App\Http\Controllers\Companies;

use App\Http\Controllers\Controller;
use App\Http\Resources\Companies\PositionResource;
use App\Models\Companies\Position;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class PositionController extends Controller
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
        $data = Position::with('users');

        if ($name = request()->query('name', null)) $data->where('name', 'like', "%$name%");

        return request()->has('no_pagination') ? PositionResource::collection($data->get()) : PositionResource::collection($data->paginate());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return PositionResource
     */
    public function store(Request $request)
    {
        $this->middleware('auth.permission:can_add_user');

        $company_id = auth()->user()->department->company->id;

        $data = Position::create([
            'company_id' => $company_id,
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'quantity_needed' => $request->input('quantity_needed'),
        ]);
        $data->remark = $request->input('remark');

        return new PositionResource($data);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return PositionResource
     */
    public function show($id)
    {
        $data = Position::findOrFail($id);
        return new PositionResource($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return PositionResource
     */
    public function update(Request $request, $id)
    {
        $data = Position::findOrFail($id);

        $data->name = $request->input('name');
        $data->description = $request->input('description');
        $data->quantity_needed = $request->input('quantity_needed');
        $data->remark = $request->input('remark');

        if ($data->save()) {
            return new PositionResource($data);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return PositionResource
     * @throws Exception
     */
    public function destroy($id)
    {
        $data = Position::findOrFail($id);
        if ($data->delete()) {
            return new PositionResource($data);
        }
    }
}
