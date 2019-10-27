<?php

namespace App\Http\Controllers\Accounts;

use App\Http\Controllers\Controller;
use App\Http\Resources\Accounts\ContactPersonResource;
use App\Models\Accounts\ContactPerson;
use App\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class ContactPersonController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return AnonymousResourceCollection
     */
    public function index()
    {
        $data = ContactPerson::paginate();
        return ContactPersonResource::collection($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return ContactPersonResource
     */
    public function store(Request $request)
    {
        $user = User::findOrFail($request->input('user_id'));

        $data = ContactPerson::create([
            'personal_name' => $request->input('personal_name'),
            'father_name' => $request->input('father_name'),
            'grand_father_name' => $request->input('grand_father_name'),
            'sex' => $request->input('sex'),
            'phone_number' => $request->input('phone_number'),
            'employer_company' => $request->input('employer_company'),
        ]);

        $type = $request->input('type');
        if ($type == 'Voucher' && $user->contactPeople()->where('type', 'Voucher')->exists()) {
            return 'This contact already exists';
        }

        // TODO modify this if address needs to be created here
        $data->address_id = $request->input('address_id');


        if ($user->contactPeople()->save($data)) {
            return new ContactPersonResource($data);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return ContactPersonResource
     */
    public function show($id)
    {
        $data = ContactPerson::findOrFail($id);
        return new ContactPersonResource($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return ContactPersonResource
     */
    public function update(Request $request, $id)
    {
        $data = ContactPerson::findOrFail($id);

        $data->personal_name = $request->input('personal_name');
        $data->father_name = $request->input('father_name');
        $data->grand_father_name = $request->input('grand_father_name');
        $data->sex = $request->input('sex');
        $data->phone_number = $request->input('phone_number');
        $data->employer_company = $request->input('employer_company');

        if ($data->save()) {
            return new ContactPersonResource($data);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return ContactPersonResource
     * @throws Exception
     */
    public function destroy($id)
    {
        $data = ContactPerson::findOrFail($id);
        if ($data->delete()) {
            return new ContactPersonResource($data);
        }
    }
}
