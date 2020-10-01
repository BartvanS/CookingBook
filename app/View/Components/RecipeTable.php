<?php

namespace App\View\Components;

use Illuminate\View\Component;

class RecipeTable extends Component
{
    public $recipes;

    /**
     * Create a new component instance.
     *
     * @param $recipes
     */
    public function __construct($recipes)
    {
        $this->recipes = $recipes;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.recipes.recipe-table');
    }
}
