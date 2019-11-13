<?php

namespace App\Http\Controllers\Forums;

use App\Http\Controllers\Controller;
use App\Http\Resources\Accounts\UserResource;
use App\Http\Resources\Forums\ForumResource;
use App\Models\Forums\Forum;
use App\User;
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
        $data = Auth::user()->forums();

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

        $members = request()->input('member_ids');
        $members[] = $user->id;
        $data->users()->syncWithoutDetaching($members);

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
        
        $members = request()->input('member_ids');
        $data->users()->syncWithoutDetaching($members);
        
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

    public function removeMember($forumID, $memberID)
    {
        $forum = Forum::findOrFail($forumID);
        $member = User::findOrFail($memberID);

        if($forum->creator->id == $memberID){
            return reponse(['message' => 'you can not remove forum creator'], 400);
        }

        if ($forum->users()->detach($memberID)){
            return new UserResource($member);
        }

        return response(['message' => 'unable to remove member'], 400);
    }
}
