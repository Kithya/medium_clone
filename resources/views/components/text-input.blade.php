@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge(['class' => 'rounded-md border-neutral-300 bg-white text-neutral-950 shadow-sm focus:border-neutral-950 focus:ring-neutral-950 disabled:cursor-not-allowed disabled:bg-neutral-100']) }}>
