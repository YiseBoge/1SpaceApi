<?php

namespace App\Http\Resources\Companies;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RoleResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array
     */
    public function toArray($request)
    {
        $resource = [
            'id' => $this->id,
            'company' => $this->company,
            'users' => $this->users,

            'name' => $this->name,
            'description' => $this->description,
            'remark' => $this->remark,

            // TODO check out how to show the permissions

            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'deleted_at' => $this->deleted_at,
        ];


        return array_merge($resource, parent::toArray($request));
    }
}
