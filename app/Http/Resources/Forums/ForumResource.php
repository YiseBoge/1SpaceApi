<?php

namespace App\Http\Resources\Forums;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ForumResource extends JsonResource
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
            'creator' => $this->creator,
            'members' => $this->users,
            'posts' => $this->forumPosts,

            'title' => $this->title,
            'description' => $this->description,
            'forum_type' => $this->forum_type,

            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'deleted_at' => $this->deleted_at,
        ];
    }
}
