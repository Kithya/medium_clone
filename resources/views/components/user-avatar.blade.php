@props(['user', 'size' => 'w-12 h-12'])

@if ($user->imageUrl())
    <img src="{{ $user->imageUrl() }}" alt="{{ $user->name }}" {{ $attributes->merge(['class' => "{$size} rounded-full object-cover"]) }}>
@else
    @php
        $initials = collect(explode(' ', $user->name))
            ->filter()
            ->map(fn ($part) => \Illuminate\Support\Str::substr($part, 0, 1))
            ->take(2)
            ->implode('');
    @endphp

    <div {{ $attributes->merge(['class' => "{$size} inline-flex items-center justify-center rounded-full bg-neutral-900 text-sm font-semibold uppercase text-white"]) }}>
        {{ $initials ?: '?' }}
    </div>
@endif
