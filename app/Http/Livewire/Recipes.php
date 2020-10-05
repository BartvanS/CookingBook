<?php

namespace App\Http\Livewire;

use App\Models\Recipe;
use Livewire\Component;
use Livewire\WithPagination;

class Recipes extends Component
{
    use WithPagination;

    public $search = '';

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $query = "%" . $this->search . "%";
        return view('livewire.show-recipes', [
            'recipes' => Recipe::where('title', 'like', $query)->paginate(10),
        ]);
    }
}
