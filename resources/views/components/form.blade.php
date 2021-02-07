@props(['title'])

<form {{ $attributes->merge(['method' => 'post', 'class' => 'surface container mx-auto max-w-md flex flex-col p-5']) }}
      enctype="multipart/form-data">
    @csrf
    {{ $slot }}
</form>
