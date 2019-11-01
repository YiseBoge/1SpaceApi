<?php

namespace App\Http\Controllers\Notices;

use App\Http\Controllers\Controller;
use App\Http\Resources\Notices\NoticeResource;
use App\Models\Notices\Notice;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\Auth;

class NoticeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
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
        $data = Notice::with([]);

        if ($poster_id = request()->query('poster_id', null)) $data->where('poster_id', '=', $poster_id);

        if ($title = request()->query('title', null)) $data->where('title', 'like', "%$title%");
        if ($description = request()->query('description', null)) $data->where('description', 'like', "%$description%");

        return request()->has('no_pagination') ? NoticeResource::collection($data->get()) : NoticeResource::collection($data->paginate());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return NoticeResource
     */
    public function store(Request $request)
    {
        $user = Auth::user();

        $data = Notice::create([
            'poster_id' => $user->id,
            'title' => $request->input('title'),
            'description' => $request->input('description'),
        ]);
        $data->target_date = $request->input('target_date');
        $data->remind_before = $request->input('remind_before');

        $members = (array)json_decode(request()->input('members'));
        $data->users()->attach($members);

        return new NoticeResource($data);
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
