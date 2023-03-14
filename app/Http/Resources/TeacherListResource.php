<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TeacherListResource extends JsonResource
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
            "phone" => $this->phone,
            "country" => $this->country,
            "email" => $this->user->email,
            "first_name" => $this->user->first_name,
            "last_name" => $this->user->last_name,
            "user_id" => $this->user_id,
            'student' => StudentResource::collection($this->student),
            'subject' => SubjectResource::collection($this->subject),
        ];
    }
}
