<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

final class Comment extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'message',
        'recipe_id',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function recipe(): BelongsTo
    {
        return $this->belongsTo(Recipe::class);
    }

    protected static function boot(): void
    {
        parent::boot();

        static::creating(function (Comment $comment): void {
            if (is_null($comment->user_id) && Auth::check()) {
                $comment->user_id = Auth::id();
            }
        });
    }
}
