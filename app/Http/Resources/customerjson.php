<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class customerjson extends JsonResource
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
            'Whatsapp number' => $this->Whatsapp_number,
            'Id number' => $this->id_number,
            'Birth Date' => $this->birthDate,
            'Gender' => $this->gender,
            'address' => $this->address,
            'slug' => $this->slug,
            'user' => new userjson($this->user),
        ];
    }
}
