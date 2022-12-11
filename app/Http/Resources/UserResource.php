<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
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
            'name' => $this->name,
            'password' => $this->password,
            'role_as' => $this->role_as,
            'auth_type' => $this->auth_type,
            'dob' => $this->dob,
            'address' => $this->address,
            'gender' => $this->gender,
            'phone' => $this->phone_no,
            'slider' => new SliderResource($this->slider)
        ];
    }
}
