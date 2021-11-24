@php
$class = [
    'success' => [
        'container' => 'bg-green-300  text-green-700',
        'header' => 'border-green-600',
        'message' => 'text-green-800',
    ],
    'danger' => [
        'container' => 'bg-red-300  text-red-700',
        'header' => 'border-red-600',
        'message' => 'text-red-800',
    ],
    'warning' => [
        'container' => 'bg-yellow-300  text-yellow-700',
        'header' => 'border-yellow-600',
        'message' => 'text-yellow-800',
    ],
];

$type = 'success';

if (session('flash-type')) {
    $type = session('flash-type');
}

@endphp

<div x-data="{ flashOpen: true }"
    x-show="flashOpen"
    x-transition:enter="transition ease-in duration-300"
    x-transition:enter-start="opacity-0 transform"
    x-transition:enter-end="opacity-100 transform"
    x-transition:leave="transition ease-in duration-300"
    x-transition:leave-start="opacity-100 transform"
    x-transition:leave-end="opacity-0 transform"
    class="fixed px-5 py-3 top-16 right-7 bg-opacity-70 rounded-md tranform transition-all w-64 {{ $class[$type]['container'] }}">
    <header class="w-full flex justify-between items-center border-b mb-3 {{ $class[$type]['header'] }}">
        <h3 class="text-xl font-bold mb-2">{{ session('type') ? ucfirst(session('type')) : 'Success' }}</h3>
        <svg class="w-5 h-5 cursor-pointer " x-on:click="flashOpen = false" fill="none" stroke="currentColor"
            viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
            </path>
        </svg>
    </header>
    <p class="font-semibold text-muted mb-2 {{ $class[$type]['message'] }}">{{ session('flash') }}</p>
</div>
