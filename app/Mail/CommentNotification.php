<?php

namespace App\Mail;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CommentNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $comment;
    public $post;

    public function __construct(Comment $comment, Post $post)
    {
        $this->comment = $comment;
        $this->post = $post;
    }

    public function build()
    {
        return $this->subject('New Comment on Your Post')
                    ->markdown('emails.comment_notification')
                    ->with([
                        'comment' => $this->comment,
                        'post' => $this->post
                    ]);
    }
}