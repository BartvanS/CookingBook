@props(['label'])

<div {{ $attributes->merge(['class' => 'px-4 py-5 border-t border-gray-200 dark:border-gray-600']) }}>
    <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">
        {{ $label }}
    </dt>
    <dd class="mt-1 text-sm text-gray-900 dark:text-gray-200">
        {{ $slot }}
    </dd>
</div>
