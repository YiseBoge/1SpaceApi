<?php

namespace App\Http\Resources\Projects;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProjectResource extends JsonResource
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
            'category' => $this->projectCategory,
            'pmo' => $this->pmo,
            'coordinates' => $this->coordinates,
            'files' => $this->files,

            'name' => $this->name,
            'description' => $this->description,

            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'deleted_at' => $this->deleted_at,
        ];
    }
}
