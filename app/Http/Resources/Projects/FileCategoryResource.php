<?php

namespace App\Http\Resources\Projects;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FileCategoryResource extends JsonResource
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
            'parent_category' => $this->parentCategory,
            'sub_categories' => FileCategoryResource::collection($this->subCategories),
            'files' => $this->files,

            'name' => $this->name,
            'description' => $this->description,

            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'deleted_at' => $this->deleted_at,
        ];
    }
}
