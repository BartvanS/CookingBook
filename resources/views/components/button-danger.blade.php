@props(['component' => 'a'])

<{{ $component }} {{ $attributes->merge(['class' => 'inline-flex items-center justify-center px-4 py-2 border border-transparent font-medium rounded-md text-red-700 bg-red-100 hover:bg-red-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:text-sm']) }}>
{{ $slot }}
</{{ $component }}>
