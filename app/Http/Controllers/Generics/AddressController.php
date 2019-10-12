<?php

namespace App\Http\Controllers\Generics;

use App\Http\Controllers\Controller;
use App\Http\Resources\Generics\AddressResource;
use App\Models\Generics\Address;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;

class AddressController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return AnonymousResourceCollection
     */
    public function index()
    {
        $data = Address::paginate();
        return AddressResource::collection($data);
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
     * @return AddressResource
     */
    public function store(Request $request)
    {
        $data = Address::create([
            'title' => $request->input('title'),
            'zone' => $request->input('zone'),
            'woreda' => $request->input('woreda'),
            'city' => $request->input('city'),
            'sub_city' => $request->input('sub_city'),
            'kebele' => $request->input('kebele'),
            'block_no' => $request->input('block_no'),
            'house_no' => $request->input('house_no'),
        ]);

        if ($data->save()) {
            return new AddressResource($data);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return AddressResource
     */
    public function show($id)
    {
        $data = Address::findOrFail($id);
        return new AddressResource($data);
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
     * @return AddressResource
     */
    public function update(Request $request, $id)
    {
        $data = Address::findOrFail($id);

        $data->region = $request->input('region');
        $data->zone = $request->input('zone');
        $data->woreda = $request->input('woreda');
        $data->city = $request->input('city');
        $data->sub_city = $request->input('sub_city');
        $data->kebele = $request->input('kebele');
        $data->block_no = $request->input('block_no');
        $data->house_no = $request->input('house_no');

        if ($data->save()) {
            return new AddressResource($data);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return AddressResource
     * @throws Exception
     */
    public function destroy($id)
    {
        $data = Address::findOrFail($id);
        if ($data->delete()) {
            return new AddressResource($data);
        }
    }
}
