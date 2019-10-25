<?php

namespace App\Http\Resources\Accounts;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ContactPersonResource extends JsonResource
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
            'user' => $this->user,
            'address' => $this->address,

            'personal_name' => $this->personal_name,
            'father_name' => $this->father_name,
            'grand_father_name' => $this->grand_father_name,
            'sex' => $this->sex,
            'phone_number' => $this->phone_number,
            'employer_company' => $this->employer_company,
            'type' => $this->type,

            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'deleted_at' => $this->deleted_at,
        ];
    }
}
