<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ClassScheduleForTeacherDetail extends JsonResource
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
            "topic" => $this->topic,
            "duration" => $this->duration,
            "description" => $this->description,
            "zoom_link" => $this->zoom_link,
            "class_unique_id" => $this->class_unique_id,
            "selected_day" => $this->selected_day,
            'subject' => SubjectResource::make($this->subject),
            'student' => StudentResource::collection($this->student),
            "start_date" => $this->start_date,
            "end_date" => $this->end_date
        ];
    }
}
