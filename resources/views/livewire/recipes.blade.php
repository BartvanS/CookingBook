<div>
    <input wire:model="search" type="text" placeholder="Search users..."/>

    <ul>
        @foreach($recipes as $recipe)
            <li>{{ $recipe->title }}</li>
        @endforeach
    </ul>
    {{ $recipes->links() }}
</div>
