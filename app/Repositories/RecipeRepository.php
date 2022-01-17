<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\Recipe;
use App\Models\Tag;

final class RecipeRepository
{
    /**
     * Store a new recipe in the database based on the
     */
    public function create(array $validatedValues): Recipe
    {
        $recipe = new Recipe();
        $recipe->fill($validatedValues);

        $recipe->category()->associate($validatedValues['category']);

        $recipe->save();

        $recipe->ingredients()->saveMany($validatedValues['ingredients']);

        $recipe->instructions()->saveMany($validatedValues['instructions']);

        if (isset($validatedValues['tags'])) {
            $this->tags($recipe, $validatedValues['tags']);
        }

        return $recipe;
    }

    /**
     * Update a recipe in the database
     */
    public function update(Recipe $recipe, array $validatedValues): Recipe
    {
        $recipe->category()->associate($validatedValues['category']);
        $recipe->update($validatedValues);

        $recipe->ingredients()->delete();
        $recipe->ingredients()->saveMany($validatedValues['ingredients']);

        $recipe->instructions()->delete();
        $recipe->instructions()->saveMany($validatedValues['instructions']);

        if (isset($validatedValues['tags'])) {
            $this->tags($recipe, $validatedValues['tags']);
        }

        return $recipe;
    }

    private function tags(Recipe $recipe, array $rawTags): void
    {
        $original = collect($rawTags);

        if ($original->isEmpty()) {
            $recipe->tags()->detach();

            return;
        }

        $tags = Tag::whereIn('slug', $original->keys())->get();

        // Not all tags are found
        if ($original->count() !== $tags->count()) {
            foreach ($original as $slug => $name) {
                if ($tags->contains(fn (Tag $tag) => $tag->slug === $slug)) {
                    continue;
                }

                // Add new tag to the collection
                $tags->add(Tag::create([
                    'name' => $name,
                    'slug' => $slug,
                ]));
            }
        }

        $recipe->tags()->sync($tags);
    }
}
