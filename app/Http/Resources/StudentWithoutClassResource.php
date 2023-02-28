<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class StudentWithoutClassResource extends JsonResource
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
            "email" => $this->user->email,
            'teacher' => TeacherResource::collection($this->teacher),
            'subject' => SubjectResource::collection($this->subject),
            'guardian' => GuardianResource::collection($this->guardian),
        ];
    }
}
