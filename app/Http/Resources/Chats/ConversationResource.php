<?php

namespace App\Http\Resources\Chats;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Chats\PrivateMessageResource;

class ConversationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return parent::toArray($request);
    }

    public function with($request)
    {
        return [
            'last_message' => new PrivateMessageResource($this->messages()->orderBy('updated_at')->first()),
            'has_unread' => empty($this->messages()->where('is_read', false)) ? false : true,
        ];
    }
}
