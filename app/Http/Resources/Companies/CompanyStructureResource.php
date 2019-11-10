<?php

namespace App\Http\Resources\Companies;

use Illuminate\Http\Resources\Json\JsonResource;

class CompanyStructureResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'name' => $this->name,
            'subordinates' => CompanyStructureResource::collection($this->subDepartments),
            'designation' => '',
            'img' => ''
        ];
    }
}
