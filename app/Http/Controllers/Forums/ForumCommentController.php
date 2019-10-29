<?php

namespace App\Http\Controllers\Forums;

use App\Http\Controllers\Controller;
use App\Http\Resources\Forums\ForumCommentResource;
use App\Models\Forums\ForumComment;
use App\Models\Forums\ForumPost;
use App\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class ForumCommentController extends Controller
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
        
        $data = ForumComment::where($queries);

        return request()->has('no_pagination') ? ForumCommentResource::collection($data->get()) : ForumCommentResource::collection($data->paginate());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return ForumCommentResource
     */
    public function store(Request $request)
    {
        User::findOrFail($request->input('commenter_id'));
        ForumPost::findOrFail($request->input('forum_post_id'));

        $data = ForumComment::create([
            'forum_post_id' => $request->input('forum_post_id'),
            'commenter_id' => $request->input('commenter_id'),
            'comment' => $request->input('comment'),
        ]);

        return new ForumCommentResource($data);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return ForumCommentResource
     */
    public function show($id)
    {
        $data = ForumComment::findOrFail($id);
        return new ForumCommentResource($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return ForumCommentResource
     */
    public function update(Request $request, $id)
    {
        $data = ForumComment::findOrFail($id);

        $data->comment = $request->input('comment');

        if ($data->save()) {
            return new ForumCommentResource($data);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return ForumCommentResource
     * @throws Exception
     */
    public function destroy($id)
    {
        $data = ForumComment::findOrFail($id);
        if ($data->delete()) {
            return new ForumCommentResource($data);
        }
    }
}
