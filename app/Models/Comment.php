<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Builder;
use App\Events\CommentSubmitted;

class Comment extends Model
{
    protected $fillable = [
        'post_id',
        'author_name',
        'author_email',
        'content',
        'status',
    ];

    /**
     * Boot the model.
     */
    protected static function boot()
    {
        parent::boot();

        // Dispatch event when comment is created
        static::created(function ($comment) {
            event(new CommentSubmitted($comment));
        });
    }

    /**
     * Get the post this comment belongs to.
     */
    public function post(): BelongsTo
    {
        return $this->belongsTo(Post::class);
    }

    /**
     * Scope to get only approved comments.
     */
    public function scopeApproved(Builder $query): Builder
    {
        return $query->where('status', 'approved');
    }

    /**
     * Scope to get pending comments.
     */
    public function scopePending(Builder $query): Builder
    {
        return $query->where('status', 'pending');
    }

    /**
     * Approve this comment.
     */
    public function approve(): void
    {
        $this->update(['status' => 'approved']);
    }

    /**
     * Reject this comment.
     */
    public function reject(): void
    {
        $this->update(['status' => 'rejected']);
    }
}
