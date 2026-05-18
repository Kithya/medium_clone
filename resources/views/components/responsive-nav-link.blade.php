@props(['active'])

@php
$classes = ($active ?? false)
            ? 'block w-full rounded-md px-3 py-2 text-start text-base font-medium text-neutral-950 bg-neutral-100 focus:outline-none focus:ring-2 focus:ring-neutral-950'
            : 'block w-full rounded-md px-3 py-2 text-start text-base font-medium text-neutral-600 transition hover:bg-neutral-100 hover:text-neutral-950 focus:outline-none focus:ring-2 focus:ring-neutral-950';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
