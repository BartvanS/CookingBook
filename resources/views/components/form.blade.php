@props(['title'])

<form {{ $attributes->merge(['method' => 'post', 'class' => 'bg-white rounded-lg container mx-auto max-w-md relative mt-12']) }}>
    @csrf
    <div class="font-bold text-xl bg-white rounded-full px-3 py-2 absolute ml-5 shadow"
         style="margin-top: -25px">
        {{ $title }}
    </div>
    <div class="flex flex-col p-5 pt-6">
        {{ $slot }}
    </div>
</form>
