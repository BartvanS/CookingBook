<?php

namespace App\View\Components;

use Illuminate\View\Component;

class TextArea extends Component
{
    public $id;
    public $class;
    public $label;

    public function __construct($id, $class, $label)
    {
        $this->id = $id;
        $this->class = $class;
        $this->label = $label;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.text-area');
    }
}
