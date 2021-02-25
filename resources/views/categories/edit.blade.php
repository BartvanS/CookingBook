<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit category') }}
        </h2>
    </x-slot>

    <x-container>

        <x-form-section :title="__('Update category')"
                        :route="route('categories.update', $category)"
                        method="put">
            <div>
                <div class="md:w-2/3">
                    <x-input name="name"
                             type="text"
                             label="{{ __('Name') }}"
                             :default="$category->name"/>
                </div>
            </div>

            <x-slot name="actions">
                <x-button-primary component="button" type="submit">
                    {{ __('Update') }}
                </x-button-primary>
            </x-slot>
        </x-form-section>

    </x-container>

</x-app-layout>
