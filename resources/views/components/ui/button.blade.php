@php

$class = [
    'primary' => 'bg-purple-600 hover:bg-purple-800 text-white ',
    'outline-primary' => 'text-purple-800 border border-purple-800 hover:bg-purple-800 hover:text-white text-white',
    'outline-danger' => 'border border-red-600 text-red-600 hover:bg-red-600 focus:border-red-600 hover:text-white transition-all duration-200',
    'secondary' => 'bg-gray-600 hover:bg-gray-800 text-white',
];

$availableVariants = ['primary', 'outline-primary', 'outline-danger', 'secondary'];

if (!isset($variant) || !in_array($variant, $availableVariants)) {
    $variant = 'primary';
}

@endphp


<button type="{{ $type ?? 'button' }}"
    {{ $attributes->merge(['class' => "{$class[$variant]} rounded-md font-semibold transition-all px-3 py-2"]) }}>
    {{ $slot }}
</button>
