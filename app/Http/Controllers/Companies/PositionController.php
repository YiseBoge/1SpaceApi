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
    /**
     * Display a listing of the resource.
     *
     * @return AnonymousResourceCollection
     */
    public function index()
    {
        $data = Position::paginate();
        return PositionResource::collection($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return PositionResource
     */
    public function store(Request $request)
    {
        $data = Position::create([
            'company_id' => $request->input('company_id'),
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'quantity_needed' => $request->input('quantity_needed'),
        ]);

        $data->remark = $request->input('remark');

        if ($data->save()) {
            return new PositionResource($data);
        }
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
