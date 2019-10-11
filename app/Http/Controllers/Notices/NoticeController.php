<?php

namespace App\Http\Controllers\Notices;

use App\Http\Controllers\Controller;
use App\Http\Resources\Notices\NoticeResource;
use App\Models\Notices\Notice;
use App\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;

class NoticeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return AnonymousResourceCollection
     */
    public function index()
    {
        $data = Notice::all();
        return NoticeResource::collection($data);
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
     * @return NoticeResource
     */
    public function store(Request $request)
    {
        $user = User::findOrFail($request->input('poster_id'));

        $data = Notice::create([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
        ]);

        $data->target_date = $request->input('target_date');
        $data->remind_before = $request->input('remind_before');

        if ($user->postedNotices()->save($data)) {
            return new NoticeResource($data);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return NoticeResource
     */
    public function show($id)
    {
        $data = Notice::findOrFail($id);
        return new NoticeResource($data);
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
     * @return NoticeResource
     */
    public function update(Request $request, $id)
    {
        $data = Notice::findOrFail($id);

        $data->title = $request->input('title');
        $data->description = $request->input('description');
        $data->target_date = $request->input('target_date');
        $data->remind_before = $request->input('remind_before');

        if ($data->save()) {
            return new NoticeResource($data);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return NoticeResource
     * @throws Exception
     */
    public function destroy($id)
    {
        $data = Notice::findOrFail($id);
        if ($data->delete()) {
            return new NoticeResource($data);
        }
    }
}
