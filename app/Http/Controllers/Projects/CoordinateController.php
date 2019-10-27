<?php

namespace App\Http\Controllers\Projects;

use App\Http\Controllers\Controller;
use App\Http\Resources\Projects\CoordinateResource;
use App\Models\Projects\Coordinate;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class CoordinateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return AnonymousResourceCollection
     */
    public function index()
    {
        $data = Coordinate::paginate();
        return CoordinateResource::collection($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return CoordinateResource
     */
    public function store(Request $request)
    {
        $data = Coordinate::create([
            'project_id' => $request->input('project_id'),
            'value_x' => $request->input('value_x'),
            'value_y' => $request->input('value_y'),
        ]);

        if ($data->save()) {
            return new CoordinateResource($data);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return CoordinateResource
     */
    public function show($id)
    {
        $data = Coordinate::findOrFail($id);
        return new CoordinateResource($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return CoordinateResource
     */
    public function update(Request $request, $id)
    {
        $data = Coordinate::findOrFail($id);

        $data->value_x = $request->input('value_x');
        $data->value_y = $request->input('value_y');

        if ($data->save()) {
            return new CoordinateResource($data);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return CoordinateResource
     * @throws Exception
     */
    public function destroy($id)
    {
        $data = Coordinate::findOrFail($id);
        if ($data->delete()) {
            return new CoordinateResource($data);
        }
    }
}
