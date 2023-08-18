<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CourseResource extends JsonResource
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
            'price' => $this->price,
            'user_id' => $this->user_id,
            'discount' => $this->discount,
            'status' => $this->status,
            'featured' => $this->featured,
            'category_id' => $this->category_id,
            'image' => $this->image,
            'description' => $this->description,
            'is_free' => $this->is_free,
            'modules' => ModuleResource::collection($this->whenLoaded('modules')),
            'users' => UserResource::collection($this->whenLoaded('users')),
            'studies'=>StudyResource::collection($this->whenLoaded('studies')),
            'quiz'=>QuizResource::collection($this->whenLoaded('quiz')),
        ];
    }
}
