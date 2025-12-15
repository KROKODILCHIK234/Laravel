<?php

namespace App\Listeners;

use App\Events\CommentSubmitted;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class NotifyAdminOfNewComment
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(CommentSubmitted $event): void
    {
        \Log::info('New comment submitted for moderation:', [
            'id' => $event->comment->id,
            'post_id' => $event->comment->post_id,
            'author' => $event->comment->author_name,
            'status' => $event->comment->status,
        ]);
    }
}
