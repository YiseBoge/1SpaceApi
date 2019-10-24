<?php

namespace App\Http\Resources\Forums;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ForumCommentResource extends JsonResource
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
            'forum_post' => $this->forumPost,
            'commenter' => $this->commenter,

            'comment' => $this->comment,

            'timestamps' => [
                'created_at' => $this->created_at,
                'updated_at' => $this->updated_at,
                'deleted_at' => $this->deleted_at,
            ],
        ];
    }
}
