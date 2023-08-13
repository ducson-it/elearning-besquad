<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CategoryPostsResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'content' => $this->content,
            'view' => $this->view,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'deleted_at' => $this->deleted_at,
            'user_id' => [
                'id' => $this->user->id,
                'user' => $this->user->name,
                'avatar' => $this->user->avatar,
            ],
            'star' => $this->star,
            'is_active' => $this->is_active,
            'type' => [
                'id' => $this->type,
                'type' => $this->type == 1 ? 'Thắc mắc'
                    : ($this->type == 2 ? 'Câu hỏi'
                        : ($this->type == 3 ? 'Thảo luận'
                            : ($this->type == 4 ? 'Giải trí' : 'Không xác định')))
            ],
            'comments' => CommentResource::collection($this->comments),
        ];
    }
}
