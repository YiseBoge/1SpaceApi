<?php

namespace App\Http\Resources\Projects;

use App\Http\Resources\Generics\FileResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TeamMemberResource extends JsonResource
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
            'pmo' => $this->pmo,
            'user' => $this->user,
            'files' => FileResource::collection($this->files),

            'name' => $this->name,
            'description' => $this->description,

            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'deleted_at' => $this->deleted_at,
        ];
    }
}