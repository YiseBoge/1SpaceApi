<?php

namespace App\Http\Controllers\Companies;

use App\Http\Controllers\Controller;
use App\Http\Resources\Companies\CompanyResource;
use App\Models\Companies\Company;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return AnonymousResourceCollection
     */
    public function index()
    {
        return CompanyResource::collection(Company::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return CompanyResource
     */
    public function store(Request $request)
    {
        $data = Company::create([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'category' => $request->input('category'),
        ]);

        return new CompanyResource($data);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return CompanyResource
     */
    public function show($id)
    {
        $data = Company::findOrFail($id);
        return new CompanyResource($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return CompanyResource
     */
    public function update(Request $request, $id)
    {
        $data = Company::findOrFail($id);

        $data->name = $request->input('name');
        $data->description = $request->input('description');
        $data->category = $request->input('category');

        if ($data->save()) {
            return new CompanyResource($data);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return CompanyResource
     * @throws Exception
     */
    public function destroy($id)
    {
        $data = Company::findOrFail($id);
        if ($data->delete()) {
            return new CompanyResource($data);
        }
    }
}
