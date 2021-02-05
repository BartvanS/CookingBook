<?php

declare(strict_types=1);

namespace App\Http\Livewire;

use App\Models\Comment;
use App\Models\Recipe;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Gate;
use Livewire\Component;
use Livewire\WithPagination;

final class CommentsList extends Component
{
    use WithPagination;

    public ?Recipe $recipe = null;

    public ?string $message = null;

    public function mount(?Recipe $recipe = null)
    {
        if ($recipe->exists) {
            $this->recipe = $recipe;
        }
    }

    public function submit()
    {
        Gate::authorize('create', Comment::class);

        $data = $this->validate([
            'message' => ['required', 'string', 'max:1000'],
        ]);

        $comment = Comment::make($data);
        $comment->recipe()->associate($this->recipe);
        $comment->save();

        $this->message = '';
        $this->resetPage();
    }

    public function render()
    {
        $comments = $this->query()->paginate(3);

        return view('livewire.comments-list')->with('comments', $comments);
    }

    protected function query(): Builder
    {
        return Comment::with('user')
            ->when($this->recipe instanceof Recipe, function (Builder $query) {
                $query->where('recipe_id', '=', $this->recipe->id);
            })
            ->latest();
    }
}
