<?php

namespace App\Http\Controllers\Chats;

use App\User;
use Exception;
use Illuminate\Http\Request;
use App\Models\Chats\Conversation;
use App\Http\Controllers\Controller;
use App\Models\Chats\PrivateMessage;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\Chats\PrivateMessageResource;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class PrivateMessageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return AnonymousResourceCollection
     */
    public function index()
    {
        $data = PrivateMessage::orderBy('created_at',  'desc');

        if ($starter_id = request()->query('starter_id', null)) $data->where('starter_id', '=', $starter_id);
        if ($receiver_id = request()->query('receiver_id', null)) $data->where('receiver_id', '=', $receiver_id);
        if ($conversation_id = request()->query('conversation_id', null)) $data->where('conversation_id', '=', $conversation_id);

        return request()->has('no_pagination') ? PrivateMessageResource::collection($data->get()) : PrivateMessageResource::collection($data->paginate());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return PrivateMessageResource
     */
    public function store(Request $request)
    {
        $user = Auth::user();
        User::findOrFail($request->input('receiver_id'));
        Conversation::findOrFail($request->input('conversation_id'));

        // $data = PrivateMessage::create([
        //     'content' => $request->input('content'),
        // ]);

        $data = new PrivateMessage();

        $data->content = $request->input('content');
        $data->sender_id = $user->id;
        $data->receiver_id = $request->input('receiver_id');
        $data->conversation_id = $request->input('conversation_id');
        $data->save();

        return new PrivateMessageResource($data);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return PrivateMessageResource
     */
    public function show($id)
    {
        $data = PrivateMessage::findOrFail($id);
        $data->is_read = true;
        $data->save();
        return new PrivateMessageResource($data->fresh());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return PrivateMessageResource
     */
    public function update(Request $request, $id)
    {
        $data = PrivateMessage::findOrFail($id);

        $data->content = $request->input('content');
        $data->is_read = $request->input('is_read');

        if ($data->save()) {
            return new PrivateMessageResource($data);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return PrivateMessageResource
     * @throws Exception
     */
    public function destroy($id)
    {
        $data = PrivateMessage::findOrFail($id);
        if ($data->delete()) {
            return new PrivateMessageResource($data);
        }
    }
}
