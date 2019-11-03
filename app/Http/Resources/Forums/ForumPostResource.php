<?php

namespace App\Http\Resources\Forums;

use App\Http\Resources\Accounts\UserResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;
use phpDocumentor\Reflection\Types\Boolean;

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
            'poster' => new UserResource($this->poster),
            'comments' => $this->forumComments,
            'likes' => $this->likes()->count(),
            'has_liked' => $this->likes()->wherePivot('user_id',Auth::user()->id)->exists(),
            'file' => $this->getFileUrl(),

            'content' => $this->content,

            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'deleted_at' => $this->deleted_at,
        ];
    }
}
