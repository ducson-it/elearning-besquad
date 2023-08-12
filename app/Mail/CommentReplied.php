<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Comment;

class CommentReplied extends Mailable
{
    use Queueable, SerializesModels;

    public $reply;

    public function __construct(Comment $reply)
    {
        $this->reply = $reply;
    }

    public function build()
    {
        return $this->subject('New Comment Reply')->view('comments.replied');
    }
}
