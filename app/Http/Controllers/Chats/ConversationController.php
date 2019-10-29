<?php

namespace App\Http\Controllers\Chats;

use App\Http\Controllers\Controller;
use App\Http\Resources\Chats\ConversationResource;
use App\Models\Chats\Conversation;
use App\Models\Chats\PrivateMessage;
use App\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;

class ConversationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $filters = (array) json_decode(request()->input('filters'));
        $queries = [];

        foreach($filters as $key => $value) $queries[] = [$key, 'like', "%$value%"];
        
        $data = Conversation::where($queries);

        return request()->has('no_pagination') ? ConversationResource::collection($data->get()) : ConversationResource::collection($data->paginate());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        User::findOrFail($request->input('starter_id'));
        User::findOrFail($request->input('receiver_id'));

        $conversation = new Conversation();

        $conversation->starter_id = $request->input('starter_id');
        $conversation->receiver_id = $request->input('receiver_id');

        $message = new PrivateMessage();

        $message->content = $request->input('content');  
        $message->sender_id = $request->input('starter_id');
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
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Conversation::findOrFail($id);
        return new ConversationResource($data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
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
     * @return \Illuminate\Http\Response
     */
    public function getByUser($id)
    {        
        $data = Conversation::where('starter_id', $id)->orWhere('receiver_id', $id);

        return request()->has('no_pagination') ? ConversationResource::collection($data->get()) : ConversationResource::collection($data->paginate());
    }
}
