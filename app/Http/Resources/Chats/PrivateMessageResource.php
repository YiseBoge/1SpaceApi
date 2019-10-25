<?php

namespace App\Http\Resources\Chats;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PrivateMessageResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'sender' => $this->sender,
            'receiver' => $this->receiver,
            'parent_message' => $this->parentMessage,
            'forwarded_messages' => PrivateMessageResource::collection($this->forwardedMessages),

            'subject' => $this->subject,
            'content' => $this->content,
            'is_important' => $this->is_important,

            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'deleted_at' => $this->deleted_at,
        ];
    }
}
