@props(['disabled' => false])

<textarea @disabled($disabled)
    {{ $attributes->merge(['class' => 'min-h-48 rounded-md border-neutral-300 bg-white text-neutral-950 shadow-sm focus:border-neutral-950 focus:ring-neutral-950 disabled:cursor-not-allowed disabled:bg-neutral-100']) }}>{{ $slot }}</textarea>
