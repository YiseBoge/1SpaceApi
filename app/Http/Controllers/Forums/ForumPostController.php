<?php

namespace App\Http\Controllers\Forums;

use App\Http\Controllers\Controller;
use App\Http\Resources\Forums\ForumPostResource;
use App\Models\Forums\Forum;
use App\Models\Forums\ForumPost;
use App\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class ForumPostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return AnonymousResourceCollection
     */
    public function index()
    {
        $filters = (array) json_decode(request()->input('filters'));
        $queries = [];

        foreach($filters as $key => $value) $queries[] = [$key, 'like', "%$value%"];
        
        $data = ForumPost::where($queries);

        return request()->has('no_pagination') ? ForumPostResource::collection($data->get()) : ForumPostResource::collection($data->paginate());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return ForumPostResource
     */
    public function store(Request $request)
    {
        User::findOrFail($request->input('poster_id'));
        Forum::findOrFail($request->input('forum_id'));

        $data = ForumPost::create([
            'forum_id' => $request->input('forum_id'),
            'content' => $request->input('content'),
        ]);

        return new ForumPostResource($data);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return ForumPostResource
     */
    public function show($id)
    {
        $data = ForumPost::findOrFail($id);
        return new ForumPostResource($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return ForumPostResource
     */
    public function update(Request $request, $id)
    {
        $data = ForumPost::findOrFail($id);

        $data->content = $request->input('content');
        $data->likes = $request->input('likes');

        if ($data->save()) {
            return new ForumPostResource($data);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return ForumPostResource
     * @throws Exception
     */
    public function destroy($id)
    {
        $data = ForumPost::findOrFail($id);
        if ($data->delete()) {
            return new ForumPostResource($data);
        }
    }
}
