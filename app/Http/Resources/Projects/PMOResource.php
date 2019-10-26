<?php

namespace App\Http\Resources\Projects;

use App\Http\Resources\Generics\FileResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PMOResource extends JsonResource
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
            'parent_pmo' => $this->parentPMO,
            'sub_pmos' => PMOResource::collection($this->subPMOs),
            'team_members' => TeamMemberResource::collection($this->teamMembers),
            'files' => FileResource::collection($this->files),

            'title' => $this->name,
            'description' => $this->description,

            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'deleted_at' => $this->deleted_at,
        ];
    }
}
