@props(['component' => 'a'])

<{{ $component }} {{ $attributes->merge(['class' => 'inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:text-gray-100 dark:bg-gray-600 dark:hover:bg-gray-700 dark:border-gray-500']) }}>
    {{ $slot }}
</{{ $component }}>
