<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class LessonResource extends JsonResource
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
            'id' => $this->id,
            'name' => $this->name,
            'slug' => $this->slug,
            'course_id' => $this->course_id,
            'module_id' => $this->module_id,
            'document' => $this->document,
            'video_id' => $this->video_id,
            'status' => $this->status,
            'description' => $this->description,
            'is_trial_lesson' => $this->is_trial_lesson,
            'course' => new CourseResource($this->whenLoaded('course')),
            'module' => new ModuleResource($this->whenLoaded('module'))
        ];
    }
}
