<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit user') }}
        </h2>
    </x-slot>

    <x-container>

        <x-form-section :title="__('Update user')"
                        :route="route('users.update', $user)"
                        method="put">

            <div>
                <div class="md:w-2/3">
                    <x-input name="name"
                             type="text"
                             label="{{ __('Name') }}"
                             :default="$user->name"/>
                </div>
            </div>

            <div>
                <div class="md:w-2/3">
                    <x-input name="email"
                             type="email"
                             label="{{ __('Email') }}"
                             :default="$user->email"/>
                </div>
            </div>

            <x-slot name="actions">
                <x-button-primary component="button" type="submit">
                    {{ __('Update') }}
                </x-button-primary>
            </x-slot>
        </x-form-section>

        @can('delete', $user)
            <div class="hidden sm:block" aria-hidden="true">
                <div class="py-5">
                    <div class="border-t border-gray-200"></div>
                </div>
            </div>

            <x-form-section :title="__('Delete user')"
                            :route="route('users.destroy', $user)"
                            method="delete">

                <div>
                    <div class="md:w-2/3">
                        {{ __('Do you want to delete the user?') }}
                    </div>
                </div>

                <div>
                    <x-button-danger component="button" type="submit">
                        {{ __('Delete') }}
                    </x-button-danger>
                </div>
            </x-form-section>
        @endcan

    </x-container>

</x-app-layout>
