<?php

declare(strict_types=1);

namespace App\Http\Livewire\Tables;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Component;
use Livewire\WithPagination;

final class UsersTable extends Component
{
    use WithPagination;

    public ?string $search = null;

    public function updatingSearch(): void
    {
        $this->resetPage();
    }

    public function render()
    {
        $users = $this->query()->paginate(10);

        return view('livewire.tables.users-table', [
            'users' => $users,
        ]);
    }

    public function query(): Builder
    {
        return User::withCount(['recipes', 'comments'])
            ->orderByDesc('recipes_count')
            ->when($this->search, function (Builder $query): void {
                $query->where(function (Builder $query): void {
                    $query
                        ->where('name', 'like', '%' . $this->search . '%')
                        ->orWhere('email', 'like', '%' . $this->search . '%');
                });
            })
            ->latest();
    }
}
