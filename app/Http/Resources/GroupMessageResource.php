<?php

namespace App\Http\Resources;

use App\Http\Resources\Admin\UserResource;
use Illuminate\Http\Resources\Json\JsonResource;

class GroupMessageResource extends JsonResource
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
            "message" => $this->message,
            "message_type" => $this->message_type,
            "user_info" => UserResource::make($this->me),
        ];
    }
}
