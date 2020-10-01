<div>
    <input wire:model="search" type="text" placeholder="Zoek recepten...">

    <x-recipe-table :recipes="$recipes"/>


</div>
