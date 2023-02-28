<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\ClassScheduleAdvanceResource;

class AdminDashboardResource extends JsonResource
{
    public function toArray($request)
    {
         return [
            "today_class_info" => ClassScheduleAdvanceResource::collection($this['sorted_class']),
            "total_students" => $this['students'],
            "total_teachers" => $this['teachers'],
            "total_subjects" => $this['subjects'],
        ];
    }
}
