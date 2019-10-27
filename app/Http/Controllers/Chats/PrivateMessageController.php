<?php

namespace App\Http\Controllers\Chats;

use App\Http\Controllers\Controller;
use App\Http\Resources\Chats\PrivateMessageResource;
use App\Models\Chats\PrivateMessage;
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
        $data = PrivateMessage::paginate();
        return PrivateMessageResource::collection($data);
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

        $data = PrivateMessage::create([
            'subject' => $request->input('subject'),
            'content' => $request->input('content'),
        ]);

        $data->is_important = $request->input('is_important');
        $data->parent_message_id = $request->input('parent_message_id');
        $data->sender_id = $request->input('sender_id');
        $data->receiver_id = $request->input('receiver_id');

        if ($data->save()) {
            return new PrivateMessageResource($data);
        }
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

        $data->subject = $request->input('subject');
        $data->content = $request->input('content');
        $data->is_important = $request->input('is_important');

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
