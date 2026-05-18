@php
    $activeCategory = request()->route('category');
@endphp

<ul class="flex gap-2 overflow-x-auto border-b border-neutral-200 text-sm font-medium text-neutral-600">
    <li class="shrink-0">
        <a href="{{ route('dashboard') }}"
            @class([
                'inline-flex items-center border-b-2 px-1 py-4 transition-colors',
                'border-neutral-950 text-neutral-950' => request()->routeIs('dashboard'),
                'border-transparent hover:border-neutral-300 hover:text-neutral-950' => ! request()->routeIs('dashboard'),
            ])>
            All
        </a>
    </li>
    @foreach ($categories as $category)
        <li class="shrink-0">
            <a href="{{ route('post.byCategory', $category) }}"
                @class([
                    'inline-flex items-center border-b-2 px-1 py-4 transition-colors',
                    'border-neutral-950 text-neutral-950' => $activeCategory?->is($category),
                    'border-transparent hover:border-neutral-300 hover:text-neutral-950' => ! $activeCategory?->is($category),
                ])>
                {{ $category->name }}
            </a>
        </li>
    @endforeach
</ul>
