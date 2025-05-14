<?php
namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Post;
use App\Models\Comment;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use App\Mail\SummaryReport;

class ReportSummaryCommand extends Command
{
    protected $signature = 'report:summary';
    protected $description = 'Send daily summary report';

    public function handle()
    {
        $data = [
            'total_posts' => Post::count(),
            'new_posts' => Post::whereDate('created_at', today())->count(),
            'total_comments' => Comment::count(),
            'new_comments' => Comment::whereDate('created_at', today())->count(),
            'total_users' => User::count(),
            'new_users' => User::whereDate('created_at', today())->count()
        ];

        // Gửi email cho admin
        Mail::to('admin@example.com')->send(new SummaryReport($data));
        
        $this->info('Daily report sent successfully!');
    }
}
