<?php

namespace App\Http\Controllers\Chats;

use App\Http\Controllers\Controller;
use App\Http\Resources\Chats\PrivateMessageResource;
use App\Models\Chats\PrivateMessage;
use App\Models\Chats\Conversation;
use App\User;
use Exception;
use Illuminate\Http\Request;
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
        $filters = (array) json_decode(request()->input('filters'));
        $queries = [];

        foreach($filters as $key => $value) $queries[] = [$key, 'like', "%$value%"];

        $data = PrivateMessage::where($queries);

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
        User::findOrFail($request->input('sender_id'));
        User::findOrFail($request->input('receiver_id'));
        Conversation::findOrFail($request->input('conversation_id'));

        // $data = PrivateMessage::create([
        //     'content' => $request->input('content'),
        // ]);

        $data = new PrivateMessage();

        $data->content = $request->input('content');
        $data->sender_id = $request->input('sender_id');
        $data->receiver_id = $request->input('receiver_id');
        $data->conversation_id = $request->input('conversation_id');

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
        return new PrivateMessageResource($data);
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
