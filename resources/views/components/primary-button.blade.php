@props(['href' => null])
@if ($href)
    <a
        href="{{ $href }}"
        {{ $attributes->merge(['class' => 'inline-flex items-center justify-center rounded-full border border-transparent bg-neutral-950 px-4 py-2 text-sm font-medium text-white transition hover:bg-neutral-800 focus:outline-none focus:ring-2 focus:ring-neutral-950 focus:ring-offset-2']) }}>
        {{ $slot }}
    </a>
@else
    <button
        {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center justify-center rounded-full border border-transparent bg-neutral-950 px-4 py-2 text-sm font-medium text-white transition hover:bg-neutral-800 focus:outline-none focus:ring-2 focus:ring-neutral-950 focus:ring-offset-2']) }}>
        {{ $slot }}
    </button>
@endif
