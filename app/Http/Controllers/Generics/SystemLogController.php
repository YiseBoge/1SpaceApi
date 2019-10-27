<?php

namespace App\Http\Controllers\Generics;

use App\Http\Controllers\Controller;
use App\Http\Resources\Generics\SystemLogResource;
use App\Models\Generics\SystemLog;
use App\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class SystemLogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return AnonymousResourceCollection
     */
    public function index()
    {
        $data = SystemLog::paginate();
        return SystemLogResource::collection($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return SystemLogResource
     */
    public function store(Request $request)
    {
        $data = new SystemLog;
        $data->actor_id = $request->input('actor_id');
        $data->action_type = $request->input('action_type');
        $data->remark = $request->input('remark');

        $ownerId = $request->input('loggable_id');
        $owner = null;

        switch ($data->action_type) {
            case 'Add User':
                $owner = User::findOrFail($ownerId);
                break;
            default:
                break;
        }

        if ($owner->loggedItems()->save($data)) {
            return new SystemLogResource($data);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return SystemLogResource
     */
    public function show($id)
    {
        $data = SystemLog::findOrFail($id);
        return new SystemLogResource($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return SystemLogResource
     */
    public function update(Request $request, $id)
    {
        $data = SystemLog::findOrFail($id);

        $data->action_type = $request->input('action_type');

        if ($data->save()) {
            return new SystemLogResource($data);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return SystemLogResource
     * @throws Exception
     */
    public function destroy($id)
    {
        $data = SystemLog::findOrFail($id);
        if ($data->delete()) {
            return new SystemLogResource($data);
        }
    }
}
