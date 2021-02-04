<?php

declare(strict_types=1);

namespace App\Http\Livewire;

use Livewire\Component;

final class ListInput extends Component
{
    public $name;

    public $label;

    public $items = [];

    public $value;

    public function mount(string $name, string $label, array $items = [])
    {
        $this->name = $name;
        $this->label = $label;

        $old = old($name);

        if (is_string($old)) {
            $this->items = array_filter(explode(PHP_EOL, $old));
        } else {
            $this->items = $items;
        }
    }

    public function add()
    {
        if (! empty($this->value)) {
            $this->items[] = $this->value;
            $this->value = '';
        }
    }

    public function remove(int $index)
    {
        unset($this->items[$index]);
    }

    public function render()
    {
        return view('livewire.list-input');
    }
}
