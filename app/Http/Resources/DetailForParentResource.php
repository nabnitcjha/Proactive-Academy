<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class DetailForParentResource extends JsonResource
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
            "student_info" => [
                'full_name'=>$this->full_name,
                'user_id'=>$this->user_id,
                'email'=>$this->user->email,
                'phone'=>$this->phone,
            ],
            "subject_info" => SubjectResource::collection($this->subject),
            // "teacher_info" => TeacherWithoutClassResource::collection($this->teacher),
            "teacher_info" => TeacherResource::collection($this->teacher)
        ];
    }
}
