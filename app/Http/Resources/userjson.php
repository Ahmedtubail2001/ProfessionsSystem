<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class userjson extends JsonResource
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
            'email' => $this->email,
            'image' => $this->full_path,
            'phone number' => $this->phone_number,
            'role' => $this->role,
            'city' => new cityjson($this->city) 
        ];
    }
}
