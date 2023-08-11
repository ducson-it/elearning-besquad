<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;
use App\Models\Comment;

class ForumPostCollection extends ResourceCollection
{
    public function toArray($request)
    {
        return $this->collection->map(function ($post) {
            return [
                'id' => $post->id,
                'title' => $post->title,
                'content' => $post->content,
                'view' => $post->view,
                'created_at' => $post->created_at,
                'updated_at' => $post->updated_at,
                'deleted_at' => $post->deleted_at,
                'user_id' => [
                    'id' => $post->user->id,
                    'user' => $post->user->name,
                    'avatar' => $post->user->avatar,
                ],
                'star' => $post->star,
                'is_active' => $post->is_active,
                'type' => [
                    'id' => $post->type,
                    'type' => $post->type == 1 ? 'Thắc mắc'
                        : ($post->type == 2 ? 'Câu hỏi'
                            : ($post->type == 3 ? 'Thảo luận'
                                : ($post->type == 4 ? 'Giải trí' : 'Không xác định')))
                ],
                'comments' => CommentResource::collection($post->comments),
                'category' => $post->category
                    ? [
                        'id' => $post->category->id,
                        'name' => $post->category->name,
                    ]
                    : null,
            ];
        });
    }
}
