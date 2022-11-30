<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ImageResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'imageable_id' => $this->imageable_id,
            'path' => 'http://localhost:8000/images/'. $this->path,
            'imageable_type' =>  $this->imageable_type,
        ];
    }
}
