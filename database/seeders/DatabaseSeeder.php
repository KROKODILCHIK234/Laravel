<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create sample posts
        $post1 = \App\Models\Post::create([
            'title' => 'Welcome to Our Laravel Blog',
            'slug' => 'welcome-to-our-laravel-blog',
            'content' => 'This is our first blog post! We are excited to share our thoughts and ideas with you. Laravel makes building web applications a breeze with its elegant syntax and powerful features.',
            'status' => 'published',
            'published_at' => now()->subDays(2),
        ]);

        $post2 = \App\Models\Post::create([
            'title' => 'Getting Started with Laravel Events',
            'slug' => 'getting-started-with-laravel-events',
            'content' => 'Events provide a simple observer pattern implementation, allowing you to subscribe and listen for various events that occur within your application. This post will be auto-published in 2 minutes!',
            'status' => 'scheduled',
            'published_at' => now()->addMinutes(2),
        ]);

        $post3 = \App\Models\Post::create([
            'title' => 'Building RESTful APIs',
            'slug' => 'building-restful-apis',
            'content' => 'RESTful APIs are the backbone of modern web applications. In this post, we explore best practices for building robust and scalable APIs with Laravel.',
            'status' => 'published',
            'published_at' => now()->subDay(),
        ]);

        $post4 = \App\Models\Post::create([
            'title' => 'Draft Post - Coming Soon',
            'slug' => 'draft-post-coming-soon',
            'content' => 'This is a draft post that is not yet published. It will be available soon!',
            'status' => 'draft',
            'published_at' => null,
        ]);

        // Create sample comments
        \App\Models\Comment::create([
            'post_id' => $post1->id,
            'author_name' => 'John Doe',
            'author_email' => 'john@example.com',
            'content' => 'Great post! Very informative.',
            'status' => 'approved',
        ]);

        \App\Models\Comment::create([
            'post_id' => $post1->id,
            'author_name' => 'Jane Smith',
            'author_email' => 'jane@example.com',
            'content' => 'Thanks for sharing this!',
            'status' => 'approved',
        ]);

        \App\Models\Comment::create([
            'post_id' => $post3->id,
            'author_name' => 'Bob Wilson',
            'author_email' => 'bob@example.com',
            'content' => 'This comment is pending moderation.',
            'status' => 'pending',
        ]);

        \App\Models\Comment::create([
            'post_id' => $post3->id,
            'author_name' => 'Alice Brown',
            'author_email' => 'alice@example.com',
            'content' => 'Another pending comment waiting for approval.',
            'status' => 'pending',
        ]);

        $this->command->info('✓ Created 4 posts (2 published, 1 scheduled, 1 draft)');
        $this->command->info('✓ Created 4 comments (2 approved, 2 pending)');
    }
}
