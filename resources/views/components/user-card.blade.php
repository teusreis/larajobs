<div {{ $attributes->merge([
    'class' => 'p-5 bg-white rounded-lg shadow-md',
]) }} >

    <h3 class="text-3xl mb-1 tracking-wider font-semibold text-purple-700">{{ $user->name }}</h3>
    <h4>{{ $user->email }}</h4>

    {{ $slot }}
</div>
