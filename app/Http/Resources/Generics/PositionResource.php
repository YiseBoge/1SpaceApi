<?php

namespace App\Http\Resources\Generics;

use App\Http\Resources\Accounts\UserResource;
use App\Models\Generics\Position;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PositionResource extends JsonResource
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
            'users' => UserResource::collection($this->users),

            'name' => $this->name,
            'description' => $this->description,
            'quantity_needed' => $this->quantity_needed,
            'remark' => $this->remark,
            'quantity_available' => $this->quantity_needed - Position::all()->count(),

            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'deleted_at' => $this->deleted_at,
        ];
    }
}
