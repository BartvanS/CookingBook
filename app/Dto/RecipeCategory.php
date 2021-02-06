<?php

declare(strict_types=1);

namespace App\Dto;

/**
 * RecipeCategory
 */
final class RecipeCategory
{
    public const APPETIZER = 'appetizer';

    public const ENTREE = 'entree';

    public const MAIN = 'main';

    public const DESSERT = 'dessert';

    public static function all(): array
    {
        return [
            self::APPETIZER,
            self::ENTREE,
            self::MAIN,
            self::DESSERT,
        ];
    }
}
