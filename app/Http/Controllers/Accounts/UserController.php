<?php

namespace App\Http\Controllers\Accounts;

use App\Http\Controllers\Controller;
use App\Http\Resources\Accounts\UserResource;
use App\Models\Accounts\FamilyStatus;
use App\Models\Generics\Address;
use App\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Validation\ValidationException;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $filters = (array) json_decode(request()->input('filters'));
        $queries = [];

        foreach($filters as $key => $value) $queries[] = [$key, 'like', "%$value%"];

        $data = User::with(['role', 'position', 'department'])->where($queries);

        return request()->has('no_pagination') ? UserResource::collection($data->get()) : UserResource::collection($data->paginate());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return UserResource
     * @throws ValidationException
     */
    public function store(Request $request)
    {
        $this->validate($request, $this->validationRules(), [], $this->validationAttribs());

        $user = new User();
        $user = $this->prepareUser($request, $user);

        $address = new Address();
        $address->save();
        $user->address_id = $address->id;


        if ($user->save()) {
            FamilyStatus::create([
                'user_id' => $user->id,
                'status' => null,
            ]);
            return new UserResource($user);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return UserResource
     */
    public function show($id)
    {
        $data = User::findOrFail($id);
        return new UserResource($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return UserResource
     * @throws ValidationException
     */
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $rules = $this->validationRules();

        if ($user->email == $request->input('email')) {
            unset($rules['email']);
        }

        if ($user->phone_number == $request->input('phone_number')) {
            unset($rules['phone_number']);
        }

        $this->validate($request, $rules, [], $this->validationAttribs());


        $user = $this->prepareUser($request, $user);

        $address = Address::create();
        $user->address_id = $address->id;


        if ($user->save()) {
            return new UserResource($user);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return UserResource
     * @throws Exception
     */
    public function destroy($id)
    {
        $data = User::findOrFail($id);
        if ($data->delete()) {
            return new UserResource($data);
        }
    }

    /**
     * @return array
     */
    private function validationRules()
    {
        return [
            'role_id' => 'required',
            'department_id' => 'required',
            'position_id' => 'required',
            'email' => 'required|unique:users',
            'phone_number' => 'required|unique:users',
            'password' => 'required|min:8',
            'personal_name' => 'required',
            'father_name' => 'required',
            'grand_father_name' => 'required',
            'sex' => 'required',
        ];
    }

    /**
     * @return array
     */
    private function validationAttribs()
    {
        return [

            'role_id' => 'role',
            'department_id' => 'department',
            'position_id' => 'position',
            'phone_number' => 'phone number',
            'personal_name' => 'personal name',
            'father_name' => 'father name',
            'grand_father_name' => 'grand father name'
        ];
    }

    /**
     * @param Request $request
     * @param User $user
     * @return User
     */
    private function prepareUser(Request $request, User $user)
    {

        $user->role_id = $request->input('role_id');
        $user->department_id = $request->input('department_id');
        $user->position_id = $request->input('position_id');
        $user->email = $request->input('email');
        $user->phone_number = $request->input('phone_number');
        $user->password = bcrypt($request->input('password'));
        $user->personal_name = $request->input('personal_name');
        $user->father_name = $request->input('father_name');
        $user->grand_father_name = $request->input('grand_father_name');
        $user->sex = $request->input('sex');

        return $user;
    }
}
