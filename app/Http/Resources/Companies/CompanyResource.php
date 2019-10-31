<?php

namespace App\Http\Resources\Companies;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CompanyResource extends JsonResource
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
            'departments' => DepartmentResource::collection($this->departments),
            'positions' => PositionResource::collection($this->positions),
            'roles' => RoleResource::collection($this->roles),

            'name' => $this->name,
            'description' => $this->description,
            'category' => $this->category,

            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'deleted_at' => $this->deleted_at,
        ];
    }
}
