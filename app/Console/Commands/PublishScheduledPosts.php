<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class PublishScheduledPosts extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'posts:publish-scheduled';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Publish posts that are scheduled and have reached their publish time';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $posts = \App\Models\Post::scheduled()->get();

        $count = 0;
        foreach ($posts as $post) {
            $post->publish();
            $count++;
            $this->info("Published: {$post->title}");
        }

        if ($count === 0) {
            $this->info('No posts to publish.');
        } else {
            $this->info("Total published: {$count}");
        }

        return Command::SUCCESS;
    }
}
