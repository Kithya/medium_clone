@php
    $activeCategory = request()->route('category');
@endphp

<ul class="flex flex-wrap -mb-px text-sm font-medium text-center text-body justify-center">
    <li class="me-2">
        <a href="{{ route('dashboard') }}"
            @class([
                'inline-flex items-center justify-center p-4 border-b-2 rounded-t-lg transition-colors duration-300 ease-in-out',
                'border-blue-500 text-blue-600' => request()->routeIs('dashboard'),
                'border-transparent hover:text-fg-brand hover:border-brand' => !request()->routeIs('dashboard'),
            ])>
            ALL
        </a>
    </li>
    @foreach ($categories as $category)
        <li class="me-2">
            <a href="{{ route('post.byCategory', $category) }}"
                @class([
                    'inline-flex items-center justify-center p-4 border-b-2 rounded-t-lg transition-colors duration-300 ease-in-out',
                    'border-blue-500 text-blue-600' => $activeCategory?->is($category),
                    'border-transparent hover:text-fg-brand hover:border-brand' => !$activeCategory?->is($category),
                ])>
                {{ $category->name }}
            </a>
        </li>
    @endforeach
</ul>
