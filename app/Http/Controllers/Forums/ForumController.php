<?php

namespace App\Http\Controllers\Forums;

use App\Http\Controllers\Controller;
use App\Http\Resources\Forums\ForumResource;
use App\Models\Forums\Forum;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\Auth;

class ForumController extends Controller
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
        $data = Forum::with([]);

        if ($creator_id = request()->query('creator_id', null)) $data->where('creator_id', '=', $creator_id);

        if ($title = request()->query('title', null)) $data->where('title', 'like', "%$title%");
        if ($description = request()->query('description', null)) $data->where('description', 'like', "%$description%");
        if ($forum_type = request()->query('forum_type', null)) $data->where('forum_type', 'like', "%$forum_type%");

        return request()->has('no_pagination') ? ForumResource::collection($data->get()) : ForumResource::collection($data->paginate());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return ForumResource
     */
    public function store(Request $request)
    {
        $user = Auth::user();
        $data = Forum::create([
            'creator_id' => $user->id,
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'forum_type' => $request->input('forum_type'),
        ]);

        $members = (array)json_decode(request()->input('members'));
        $data->users()->attach($members);

        return new ForumResource($data);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return ForumResource
     */
    public function show($id)
    {
        $data = Forum::findOrFail($id);
        return new ForumResource($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return ForumResource
     */
    public function update(Request $request, $id)
    {
        $data = Forum::findOrFail($id);

        $data->title = $request->input('title');
        $data->description = $request->input('description');

        if ($data->save()) {
            return new ForumResource($data);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return ForumResource
     * @throws Exception
     */
    public function destroy($id)
    {
        $data = Forum::findOrFail($id);
        if ($data->delete()) {
            return new ForumResource($data);
        }
    }
}
