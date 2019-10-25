<?php

namespace App\Http\Resources\Generics;

use App\Http\Resources\Accounts\UserResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DepartmentResource extends JsonResource
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
            'parent_department' => $this->parentDepartment,
            'sub_departments' => DepartmentResource::collection($this->subDepartments),
            'users' => UserResource::collection($this->users),

            'name' => $this->title,
            'description' => $this->description,
            'remark' => $this->remark,

            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'deleted_at' => $this->deleted_at,
        ];
    }
}
