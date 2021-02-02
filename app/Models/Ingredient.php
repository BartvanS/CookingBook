<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

final class Ingredient extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    public function recipe(): HasOne
    {
        return $this->hasOne(Recipe::class);
    }
}
