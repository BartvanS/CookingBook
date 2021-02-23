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

    public function updatingSearch()
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
        return User::when($this->search, function (Builder $query) {
            $query->where(function (Builder $query) {
                $query
                    ->where('name', 'like', '%' . $this->search . '%')
                    ->orWhere('email', 'like', '%' . $this->search . '%');
            });
        })
            ->latest();
    }
}
