<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class GuardianResource extends JsonResource
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
            "id" => $this->id,
            "full_name" => $this->full_name,
            "first_name" => $this->user->first_name,
            "user_id" => $this->user_id,
            "last_name" => $this->user->last_name,
            "email" => $this->user->email,
            "phone" => $this->phone
        ];
    }
}
