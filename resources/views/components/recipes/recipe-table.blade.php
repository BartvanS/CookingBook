<table class="table-auto bg-white rounded-lg shadow-lg">
    <thead>
    <tr>
        <th class="px-4 py-2">Titel</th>
        <th class="px-4 py-2">Beschrijving</th>
        <th class="px-4 py-2">Duur</th>
        <th class="px-4 py-2">Bekijk</th>
        <th class="px-4 py-2">Bewerk</th>
    </tr>
    </thead>
    <tbody>
    @foreach($recipes as $recipe)
        <tr>
            <td class="border-t px-4 py-2">{{$recipe->title }}</td>
            <td class="border-t px-4 py-2">{{ Str::limit($recipe->description, 100) }}</td>
            <td class="border-t px-4 py-2">{{$recipe->hours }}:{{$recipe->minutes}}</td>
            <td class="border-t px-4 py-2">
                <a href="{{route('recipes.show', $recipe->id)}}">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                         width="24px">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                </a>
            </td>
            <td class="border-t px-4 py-2">
                @if($recipe->user->id == \Illuminate\Support\Facades\Auth::id())
                    <a href="{{route('recipes.edit', $recipe->id)}}">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" width="20px">
                            <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"/>
                        </svg>
                    </a>
                @endif

            </td>
        </tr>
    @endforeach
    </tbody>
</table>
<div class="mt-5">
    {{ $recipes->links() }}
</div>
