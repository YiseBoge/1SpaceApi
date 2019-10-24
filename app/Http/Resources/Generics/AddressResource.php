<?php

namespace App\Http\Resources\Generics;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AddressResource extends JsonResource
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

            'region' => $this->region,
            'zone' => $this->zone,
            'woreda' => $this->woreda,
            'city' => $this->city,
            'sub_city' => $this->sub_city,
            'kebele' => $this->kebele,
            'block_no' => $this->block_no,
            'house_no' => $this->house_no,

            'timestamps' => [
                'created_at' => $this->created_at,
                'updated_at' => $this->updated_at,
                'deleted_at' => $this->deleted_at,
            ],
        ];
    }
}
