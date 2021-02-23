<div class="flex flex-col">
    <div class="flex justify-between items-center mb-5">
        <div>
            <input wire:model="search"
                   type="text"
                   name="search"
                   aria-label="{{ __('Search') }}"
                   placeholder="{{ __('Search') }} ..."
                   class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"/>
        </div>

        @can('create', \App\Models\User::class)
            <x-button-primary href="{{ route('users.create') }}">
                <x-icons.plus class="-ml-1 mr-2 h-5 w-5"/>
                {{ __('New user') }}
            </x-button-primary>
        @endcan
    </div>

    @if($users->isEmpty())
        <div class="surface flex justify-center items-center p-5 text-lg">
            {{ __('No users found') }}
        </div>
    @else
        <div class="flex flex-col">
            <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                    <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                            <tr>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    {{ __('Name') }}
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    {{ __('Role') }}
                                </th>
                                <th scope="col" class="relative px-6 py-3">
                                    <span class="sr-only">{{ __('Edit') }}</span>
                                </th>
                            </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($users as $user)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0 h-10 w-10">
                                                <img class="h-10 w-10 rounded-full"
                                                     src="{{ $user->profile_photo_url }}"
                                                     alt="">
                                            </div>
                                            <div class="ml-4">
                                                <div class="text-sm font-medium text-gray-900">
                                                    {{ $user->name }}
                                                </div>
                                                <div class="text-sm text-gray-500">
                                                    {{ $user->email }}
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ $user->is_admin ? __('Admin') : __('User') }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                        <a href="{{ route('users.edit', $user) }}"
                                           class="text-indigo-600 hover:text-indigo-900">
                                            {{ __('Edit') }}
                                        </a>
                                    </td>
                                </tr>

                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-5">
            {{ $users->links() }}
        </div>
    @endif
</div>
