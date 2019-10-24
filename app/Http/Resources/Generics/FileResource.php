<?php

namespace App\Http\Resources\Generics;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FileResource extends JsonResource
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
            'fileable' => $this->fileable,

            'file_name' => $this->file_name,
            'file_url' => $this->file_url,
            'file_type' => $this->file_type,

            'timestamps' => [
                'created_at' => $this->created_at,
                'updated_at' => $this->updated_at,
                'deleted_at' => $this->deleted_at,
            ],
        ];
    }
}
