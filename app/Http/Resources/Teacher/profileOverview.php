<?php

namespace App\Http\Resources\teacher;

use App\Http\Resources\StudentWithoutClassResource;
use App\Http\Resources\SubjectResource;
use Illuminate\Http\Resources\Json\JsonResource;

class profileOverview extends JsonResource
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
            "teacher_info" => [
                'full_name'=>$this->full_name,
                'user_id'=>$this->user_id,
                'email'=>$this->user->email,
                'phone'=>$this->phone,
            ],
            "subject_info" => SubjectResource::collection($this->subject),
            // "student_info" => StudentWithoutClassResource::collection($this->student)
        ];
    }
}
