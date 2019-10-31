<?php

namespace App\Http\Resources\Forums;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;

class ForumPostResource extends JsonResource
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
            'forum' => $this->forum,
            'poster' => $this->poster,
            'comments' => $this->forumComments,
            'likes' => $this->likes()->count(),
            'has_liked' => $this->likes()->search(Auth::user()),

            'content' => $this->content,

            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'deleted_at' => $this->deleted_at,
        ];
    }
}
