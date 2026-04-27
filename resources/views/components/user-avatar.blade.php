@props(['user', 'size' => 'w-12 h-12'])

@if ($user->image)
    <img src="{{ $user->imageUrl() }}" alt="{{ $user->name }}" {{ $attributes->merge(['class' => "{$size} rounded-full"]) }}>
@else
    <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQ4YreOWfDX3kK-QLAbAL4ufCPc84ol2MA8Xg&s" alt=""
        {{ $attributes->merge(['class' => "{$size} rounded-full"]) }}>
@endif
