@props(['title'])

<form {{ $attributes->merge(['method' => 'post', 'class' => 'surface container mx-auto max-w-md flex flex-col p-5']) }}>
    @csrf
    {{ $slot }}
</form>
