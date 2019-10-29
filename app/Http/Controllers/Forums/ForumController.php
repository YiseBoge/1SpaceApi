<?php

namespace App\Http\Controllers\Forums;

use App\Http\Controllers\Controller;
use App\Http\Resources\Forums\ForumResource;
use App\Models\Forums\Forum;
use App\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class ForumController extends Controller
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
        
        $data = Forum::where($queries);

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
        User::findOrFail($request->input('creator_id'));

        $data = Forum::create([
            'creator_id' => $request->input('creator_id'),
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'forum_type' => $request->input('forum_type'),
        ]);

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
        $data->forum_type = $request->input('forum_type');

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
