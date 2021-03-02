<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('New user') }}
        </h2>
    </x-slot>

    <x-container>

        <x-form-section :title="__('Create user')"
                        :description="__('Create a new user.')"
                        :route="route('users.store')">
            <div>
                <div class="md:w-2/3">
                    <x-input name="name"
                             type="text"
                             label="{{ __('Name') }}"/>
                </div>
            </div>

            <div>
                <div class="md:w-2/3">
                    <x-input name="email"
                             type="email"
                             label="{{ __('Email') }}"/>
                </div>
            </div>

            <div>
                <div class="md:w-2/3">
                    <x-input name="password"
                             type="password"
                             label="{{ __('Password') }}"/>
                </div>
            </div>

            <div>
                <div class="md:w-2/3">
                    <x-input name="password_confirmation"
                             type="password"
                             label="{{ __('Confirm password') }}"/>
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
