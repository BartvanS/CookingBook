<?php

declare(strict_types=1);

namespace App\Http\Livewire\Tables;

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

    public $category = null;

    public ?string $tag = null;

    public $queryString = [
        'category' => ['except' => ''],
        'tag' => ['except' => ''],
    ];

    public function mount(?User $user = null): void
    {
        if ($user->exists) {
            $this->user = $user;
        }
    }

    public function updatingSearch(): void
    {
        $this->resetPage();
    }

    public function render()
    {
        $recipes = $this->query()->paginate(9);

        return view('livewire.tables.recipes-table', [
            'recipes' => $recipes,
        ]);
    }

    public function query(): Builder
    {
        return Recipe::with('user', 'category')
            ->when($this->user instanceof User, function (Builder $query): void {
                $query->where('user_id', '=', $this->user->id);
            })
            ->when($this->search, function (Builder $query): void {
                $query->where(function (Builder $query): void {
                    $query
                        ->where('title', 'like', '%' . $this->search . '%')
                        ->orWhere('description', 'like', '%' . $this->search . '%')
                        ->orWhereHas('user', function (Builder $query): void {
                            $query->where('name', 'like', '%' . $this->search . '%');
                        })
                        ->orWhereHas('ingredients', function (Builder $query): void {
                            $query->where('name', 'like', '%' . $this->search . '%');
                        })
                        ->orWhereHas('instructions', function (Builder $query): void {
                            $query->where('instruction', 'like', '%' . $this->search . '%');
                        });
                });
            })
            ->when(intval($this->category) > 0, function (Builder $query): void {
                $query->where('category_id', '=', $this->category);
            })
            ->when(! empty($this->tag), function (Builder $query): void {
                $query->whereHas('tags', function (Builder $query): void {
                    $query->where('slug', '=', $this->tag);
                });
            })
            ->latest();
    }
}
