<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ForumPostResource extends JsonResource
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
            'title' => $this->title,
            'content' => $this->content,
            'type' => [
                'id' => $this->type,
                'type' => $this->type == 1 ? 'Thắc mắc'
                    : ($this->type == 2 ? 'Câu hỏi'
                        : ($this->type == 3 ? 'Thảo luận'
                            : ($this->type == 4 ? 'Giải trí' : 'Không xác định')))
            ],
            'created_at' => $this->created_at,
            'user' => UserResource::make($this->user),
            'category' => CategoryResource::make($this->category),
            // Include any other relevant post data
            'comments' => CommentResource::collection($this->comments),
        ];
    }
}
