<?php

namespace App\Http\Resources\Accounts;

use App\Http\Resources\Generics\FileResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
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
            'role' => $this->role,
            'department' => $this->department,
            'position' => $this->position,
            'address' => $this->address,
            'family_status' => new FamilyStatusResource($this->familyStatus),
            'work_experiences' => WorkExperienceResource::collection($this->workExperiences),
            'files' => FileResource::collection($this->files),
            'contact_people' => ContactPersonResource::collection($this->contactPeople),
            // TODO Figure out how to put in the queried relations here

            'email' => $this->email,
            'phone_number' => $this->phone_number,
            'personal_name' => $this->personal_name,
            'father_name' => $this->father_name,
            'grand_father_name' => $this->grand_father_name,
            'sex' => $this->sex,
            'birth_date' => $this->birth_date,
            'employment_date' => $this->employment_date,
            'pension_id_number' => $this->pension_id_number,

            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'deleted_at' => $this->deleted_at,
        ];
    }
}
