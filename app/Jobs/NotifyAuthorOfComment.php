<?php

namespace App\Jobs;

use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use App\Mail\CommentNotification;

class NotifyAuthorOfComment implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    
    public $tries = 3;
    public $maxExceptions = 2;
    
    public function retryUntil()
    {
        return now()->addMinutes(10);
    }

    protected $comment;
    protected $post;

    public function __construct(Comment $comment, Post $post)
    {
        $this->comment = $comment;
        $this->post = $post;
    }

    public function handle()
    {
        // Send email notification
        Mail::to($this->post->user->email)
            ->send(new CommentNotification($this->comment, $this->post));
            
        // Create database notification
        $this->post->user->notify(
            new \App\Notifications\NewCommentNotification($this->comment, $this->post)
        );
    }
}