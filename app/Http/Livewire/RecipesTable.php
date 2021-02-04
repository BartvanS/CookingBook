<?php

declare(strict_types=1);

namespace App\Http\Livewire;

use App\Models\Recipe;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Component;
use Livewire\WithPagination;

final class RecipesTable extends Component
{
    use WithPagination;

    public ?string $search = null;

    public ?User $user = null;

    public function mount(?User $user = null)
    {
        if ($user->exists) {
            $this->user = $user;
        }
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $recipes = Recipe::with('user')
            ->when($this->user instanceof User, function (Builder $query) {
                $query->where('user_id', '=', $this->user->id);
            })
            ->when($this->search, function (Builder $query) {
                $query->where(function (Builder $query) {
                    $query
                        ->where('title', 'like', '%' . $this->search . '%')
                        ->orWhere('description', 'like', '%' . $this->search . '%')
                        ->orWhereHas('user', function (Builder $query) {
                            $query->where('name', 'like', '%' . $this->search . '%');
                        });
                });
            })
            ->latest()
            ->paginate(9);

        return view('livewire.recipes', [
            'recipes' => $recipes,
        ]);
    }
}
