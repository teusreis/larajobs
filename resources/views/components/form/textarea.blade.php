<textarea
    name="{{ $name }}"
    id="{{ $id ?? $name }}"
    cols="{{ $cols ?? 30 }}"
    rows="{{ $rows ?? 10 }}"
    class="rounded w-full shadow-sm border-gray-300 my-1 focus:border-purple-300 focus:ring focus:ring-purple-200 focus:ring-opacity-50">
    {{ $slot }}
</textarea>
