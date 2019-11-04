<?php

namespace App\Http\Controllers\Chats;

use App\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Chats\Conversation;
use App\Http\Controllers\Controller;
use App\Models\Chats\PrivateMessage;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\Chats\ConversationResource;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class ConversationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return AnonymousResourceCollection
     */
    public function index()
    {
        $data = Conversation::with([]);

        if ($starter_id = request()->query('starter_id', null)) {
            $data->where('starter_id', '=', $starter_id);
        }
        if ($receiver_id = request()->query('receiver_id', null)) {
            $data->where('receiver_id', '=', $receiver_id);
        }
        if ($conversation_id = request()->query('conversation_id', null)) {
            $data->where('conversation_id', '=', $conversation_id);
        }
        if ($is_read = request()->query('is_read', null)) {
            $data->where('is_read', '=', $is_read);
        }

        return request()->has('no_pagination') ? ConversationResource::collection($data->get()) : ConversationResource::collection($data->paginate());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return ConversationResource
     */
    public function store(Request $request)
    {
        $user = Auth::user();
        User::findOrFail($request->input('receiver_id'));

        $conversation = new Conversation();

        $conversation->starter_id = $user->id;
        $conversation->receiver_id = $request->input('receiver_id');

        $message = new PrivateMessage();

        $message->content = $request->input('content');
        $message->sender_id = $user->id;
        $message->receiver_id = $request->input('receiver_id');

        $conversation->save();

        if ($conversation->messages()->save($message)) {
            return new ConversationResource($conversation);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return ConversationResource
     */
    public function show($id)
    {
        $data = Conversation::findOrFail($id);
        return new ConversationResource($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return ConversationResource
     * @throws Exception
     */
    public function destroy($id)
    {
        $data = Conversation::findOrFail($id);
        if ($data->delete()) {
            return new ConversationResource($data);
        }
    }

    /**
     * Display a listing of the resource by user.
     *
     * @param int $id
     * @return AnonymousResourceCollection
     */
    public function getByUser(int $id)
    {
        $data = Conversation::where(
            function ($query) {
                $id = Auth::user()->id;
                return $query->where('starter_id', $id)->orWhere('receiver_id', $id);
            }
        );


        $data->where(
            function ($query) use ($id) {
                return $query->where('starter_id', $id)->orWhere('receiver_id', $id);
            }
        );

        return request()->has('no_pagination') ? ConversationResource::collection($data->get()) : ConversationResource::collection($data->paginate());
    }
}
