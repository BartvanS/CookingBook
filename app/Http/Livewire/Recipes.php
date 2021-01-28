<?php

namespace App\Http\Livewire;

use App\Models\Recipe;
use Livewire\Component;
use Livewire\WithPagination;
use Symfony\Component\ErrorHandler\Debug;

class Recipes extends Component
{
    use WithPagination;

    public $search = null;
    public $likeQuery = '';

    public function mount($likeQuery)
    {
        $this->likeQuery = $likeQuery;
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $recipes = '';
        if ($this->likeQuery === "") {
            $recipes = Recipe::where('title', 'like', "%" . $this->search . "%")->paginate(10);
        } else {
            $recipes = Recipe::where('title', 'like', "%" . $this->likeQuery . "%")->paginate(10);

        }
        return view('livewire.show-recipes', [
            'recipes' => $recipes,
        ]);
    }
}
