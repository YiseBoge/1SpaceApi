<?php

namespace App\Http\Resources\Notices;

use App\Http\Resources\Accounts\UserResource;
use App\Http\Resources\Generics\FileResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class NoticeResource extends JsonResource
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
            'poster' => $this->poster,
            'target_users' => UserResource::collection($this->users),
            'files' => FileResource::collection($this->files),

            'title' => $this->title,
            'description' => $this->description,
            'target_date' => $this->target_date,
            'remind_before' => $this->remind_before,

            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'deleted_at' => $this->deleted_at,
        ];
    }

    /**
     * @param Request $request
     * @return array
     */
    public function with($request)
    {
        return [
            'type' => $this->target_date == null ? 'Notice' : 'Reminder',
        ];
    }
}
