<?php

namespace App\View\Components;

use Illuminate\View\Component;

class RecipeForm extends Component
{

    public $fields;
    /**
     * Create a new component instance.
     *
     * @param $fields
     */
    public function __construct($fields = [])
    {
        $this->fields = $fields;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.recipes.recipe-form');
    }
}
