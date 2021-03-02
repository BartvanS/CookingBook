<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('New category') }}
        </h2>
    </x-slot>

    <x-container>

        <x-form-section :title="__('Create category')"
                        :description="__('Create a new recipe category.')"
                        :route="route('categories.store')">
            <div>
                <div class="md:w-2/3">
                    <x-input name="name"
                             type="text"
                             label="{{ __('Name') }}"/>
                </div>
            </div>

            <x-slot name="actions">
                <x-button-primary component="button" type="submit">
                    {{ __('Create') }}
                </x-button-primary>
            </x-slot>
        </x-form-section>

    </x-container>

</x-app-layout>
