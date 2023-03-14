<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class StudentListResource extends JsonResource
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
            "last_name" => $this->user->last_name,
            "phone" => $this->phone,
            "user_id" => $this->user_id,
            "email" => $this->user->email,
            "dob" => $this->dob,
            "country" => $this->country,
            'teacher' => TeacherResource::collection($this->teacher),
            'subject' => SubjectResource::collection($this->subject),
            'guardian' => GuardianResource::collection($this->guardian),
        ];
    }
}
