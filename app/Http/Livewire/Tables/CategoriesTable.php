<?php

declare(strict_types=1);

namespace App\Http\Livewire\Tables;

use App\Models\Category;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Component;
use Livewire\WithPagination;

final class CategoriesTable extends Component
{
    use WithPagination;

    public ?string $search = null;

    public function updatingSearch(): void
    {
        $this->resetPage();
    }

    public function render()
    {
        $categories = $this->query()->paginate(10);

        return view('livewire.tables.categories-table', [
            'categories' => $categories,
        ]);
    }

    public function query(): Builder
    {
        return Category::withCount('recipes')
            ->when($this->search, function (Builder $query): void {
                $query->where(function (Builder $query): void {
                    $query->where('name', 'like', '%' . $this->search . '%');
                });
            })
            ->orderBy('name')
            ->latest();
    }
}
