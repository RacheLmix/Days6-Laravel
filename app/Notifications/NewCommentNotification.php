<?php

namespace App\Notifications;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewCommentNotification extends Notification implements ShouldQueue
{
    use Queueable;

    protected $comment;
    protected $post;

    public function __construct(Comment $comment, Post $post)
    {
        $this->comment = $comment;
        $this->post = $post;
    }

    public function via($notifiable)
    {
        return ['database', 'mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('New Comment on Your Post')
            ->line('Your post "'.$this->post->title.'" has a new comment')
            ->action('View Post', url('/posts/'.$this->post->id))
            ->line('Comment by: '.$this->comment->user->name)
            ->line('Comment: '.$this->comment->content);
    }

    public function toArray($notifiable)
    {
        return [
            'message' => $this->comment->user->name.' commented on your post "'.$this->post->title.'"',
            'link' => '/posts/'.$this->post->id,
            'comment_id' => $this->comment->id,
            'post_id' => $this->post->id
        ];
    }
}