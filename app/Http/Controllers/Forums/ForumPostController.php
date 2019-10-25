<?php

namespace App\Http\Controllers\Forums;

use App\Http\Controllers\Controller;
use App\Http\Resources\Forums\ForumPostResource;
use App\Models\Forums\ForumPost;
use App\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;

class ForumPostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return AnonymousResourceCollection
     */
    public function index()
    {
        $data = ForumPost::paginate();
        return ForumPostResource::collection($data);
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
     * @return ForumPostResource
     */
    public function store(Request $request)
    {
        User::findOrFail($request->input('poster_id'));
        $forum = User::findOrFail($request->input('forum_id'));

        $data = ForumPost::create([
            'content' => $request->input('content'),
        ]);

        if ($forum->forumPosts()->save($data)) {
            return new ForumPostResource($data);
        }
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
