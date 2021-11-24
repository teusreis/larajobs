<select name="{{ $name }}" id="{{ $id ?? $name }}"
    {{ $attributes->merge(['class' => 'rounded w-full shadow-sm border-gray-300 my-1 focus:border-purple-300 focus:ring focus:ring-purple-200 focus:ring-opacity-50']) }}
    type="{{ $type ?? 'select' }}" placeholder="{{ $placeholder ?? '' }}">

    @isset($placeholder)
        <option value="" disabled selected>{{ $placeholder }}</option>
    @else
        <option value=""></option>
    @endisset
    {{ $slot }}
</select>
