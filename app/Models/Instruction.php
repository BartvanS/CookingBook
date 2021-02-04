<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

final class Instruction extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'instruction',
    ];

    public function recipe(): BelongsTo
    {
        return $this->belongsTo(Recipe::class);
    }
}
