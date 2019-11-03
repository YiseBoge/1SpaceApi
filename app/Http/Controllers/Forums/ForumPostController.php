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
use Illuminate\Support\Facades\Auth;

class ForumPostController extends Controller
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
        $data = ForumPost::orderBy('created_at','desc');

        if ($forum_id = request()->input('forum_id')) $data->where('forum_id',$forum_id);

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
        Forum::findOrFail($request->input('forum_id'));

        $data = new ForumPost([
            'forum_id' => $request->input('forum_id'),
            'content' => $request->input('content'),
        ]);

        $data->poster_id = Auth::user()->id;
        $data->save();

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

    public function changeLike($id)
    {
        $data = ForumPost::findOrFail($id);
        $user = Auth::user();
        $liked = $data->likes()->wherePivot('user_id', $user->id)->exists();
        if ($liked) {
            $data->likes()->detach([$user->id]);
        }
        else{
            $data->likes()->syncWithoutDetaching([$user->id]);
        }

        return new ForumPostResource($data);
    }
}
