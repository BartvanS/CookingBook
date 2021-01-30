<?php

namespace App\View\Components\Ingredients;

use Illuminate\View\Component;

class Form extends Component
{
    public $value;

    public function __construct($value)
    {
        $this->value = $value;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.ingredients.form');
    }
}
